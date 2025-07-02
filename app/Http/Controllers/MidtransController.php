<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        Log::info('Midtrans Callback:', $request->all());

        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;
        $amount = $request->gross_amount;

        // Jika pembayaran sukses
        if ($transactionStatus == 'settlement') {
            // Simpan atau update data pembayaran
            Payment::updateOrCreate(
                ['kode_pembayaran' => $orderId],
                [
                    'amount' => $amount,
                    'CreatedDate' => now(),
                    'status' => 'settlement',
                ]
            );
        }

        return response()->json(['message' => 'Callback received']);
    }
}
