<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('shipment')->latest('CreatedDate')->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $shipments = Shipment::where('price', '>', 0)
            ->where(function ($query) {
                $query->whereDoesntHave('payments', function ($q) {
                    $q->where('IsDeleted', 0);
                })
                ->orWhereRaw('(SELECT COALESCE(SUM(amount), 0) FROM payments WHERE shipment_id = shipments.id AND IsDeleted = 0) < shipments.price');
            })
            ->get();

        return view('payments.create', compact('shipments'));
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'shipment_id' => 'required|exists:shipments,id',
            'payment_method' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        // 🔒 Validasi: Cegah kelebihan pembayaran
        $existingTotal = Payment::where('shipment_id', $request->shipment_id)
            ->where('IsDeleted', 0)
            ->sum('amount');

        $shipment = Shipment::findOrFail($request->shipment_id);

        if (($existingTotal + $request->amount) > $shipment->price) {
            return back()->withErrors(['amount' => 'Total pembayaran melebihi harga shipment.'])->withInput();
        }

        $status = 'pending';
        $paid_at = null;

        if (strtolower($request->payment_method) === 'cash') {
            $status = 'paid';
            $paid_at = now();
        }

        $payment = new Payment([
            'shipment_id' => $request->shipment_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'status' => $status,
            'paid_at' => $paid_at,
            'CompanyCode' => 'DEFAULT',
            'IsDeleted' => 0,
            'CreatedBy' => Auth::user()->name ?? 'system',
            'CreatedDate' => now(),
        ]);

        $payment->save();

        if (strtolower($request->payment_method) === 'transfer') {
            return redirect()->route('payments.pay', $payment->id);
        }

        return redirect()->route('payments.index')->with('success', 'Payment berhasil disimpan.');
    }

    public function pay($id)
    {
        $payment = Payment::with('shipment.customer')->findOrFail($id);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $payment->id . '-' . time(),
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => optional($payment->shipment->customer)->name ?? 'Customer',
                'email' => optional($payment->shipment->customer)->email ?? 'dummy@email.com',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payments.gateway', compact('snapToken'));
    }

    public function edit(Payment $payment)
    {
        $shipments = Shipment::all();
        return view('payments.edit', compact('payment', 'shipments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'shipment_id' => 'required|exists:shipments,id',
            'payment_method' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ]);

        // 🔒 Validasi: Cegah kelebihan pembayaran saat update
        $existingTotal = Payment::where('shipment_id', $request->shipment_id)
            ->where('IsDeleted', 0)
            ->where('id', '!=', $payment->id)
            ->sum('amount');

        $shipment = Shipment::findOrFail($request->shipment_id);

        if (($existingTotal + $request->amount) > $shipment->price) {
            return back()->withErrors(['amount' => 'Total pembayaran melebihi harga shipment.'])->withInput();
        }

        $paid_at = $payment->paid_at;

        if (strtolower($request->payment_method) === 'cash') {
            $status = 'paid';
            $paid_at = now();
        } else {
            $status = $request->status;
            if ($status === 'paid' && !$paid_at) {
                $paid_at = now();
            }
            if ($status !== 'paid') {
                $paid_at = null;
            }
        }

        $payment->update([
            'shipment_id' => $request->shipment_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'status' => $status,
            'paid_at' => $paid_at,
            'LastUpdatedBy' => Auth::user()->name ?? 'system',
            'LastUpdatedDate' => now(),
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment berhasil diupdate.');
    }

    public function destroy(Payment $payment)
    {
        $payment->IsDeleted = 1;
        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Payment berhasil dihapus (soft delete).');
    }

    public function notificationHandler(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $notification = new \Midtrans\Notification();

        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;
        $orderId = $notification->order_id;

        $paymentId = explode('-', $orderId)[0];
        $payment = Payment::find($paymentId);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $payment->status = 'paid';
            $payment->paid_at = now();
        } elseif ($transactionStatus == 'pending') {
            $payment->status = 'pending';
            $payment->paid_at = null;
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            $payment->status = 'failed';
            $payment->paid_at = null;
        }

        $payment->LastUpdatedBy = 'Midtrans';
        $payment->LastUpdatedDate = now();
        $payment->save();

        return response()->json(['message' => 'Notification processed']);
    }
}
