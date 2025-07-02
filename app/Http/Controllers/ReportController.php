<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Payment;
use PDF;
use Excel;
use App\Exports\ShipmentsExport;
use App\Exports\PaymentsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Http\Requests\ExportRequest;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    // ✅ Laporan Pengiriman
    public function shipment(Request $request)
    {
        $query = Shipment::where('IsDeleted', 0);

        if ($request->start_date) {
            $query->whereDate('CreatedDate', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('CreatedDate', '<=', $request->end_date);
        }

        $query->orderBy('CreatedDate', 'desc');

        $shipments = $query->get();

        return view('reports.shipment', compact('shipments'));
    }

    // ✅ Laporan Pembayaran
    public function payment(Request $request)
    {
        $query = Payment::with('shipment')->where('IsDeleted', 0);

        if ($request->start_date) {
            $query->whereDate('CreatedDate', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('CreatedDate', '<=', $request->end_date);
        }

        $query->orderBy('CreatedDate', 'desc');

        $payments = $query->get();

        return view('reports.payment', compact('payments'));
    }

    // ✅ Export Pengiriman ke Excel
    public function exportShipmentExcel(Request $request)
    {
        return Excel::download(new ShipmentsExport($request), 'laporan_pengiriman.xlsx');
    }

    // ✅ Export Pengiriman ke PDF
    public function exportShipmentPDF(Request $request)
    {
        $query = Shipment::where('IsDeleted', 0);

        if ($request->start_date) {
            $query->whereDate('CreatedDate', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('CreatedDate', '<=', $request->end_date);
        }

        $shipments = $query->orderBy('CreatedDate', 'desc')->get();

        $pdf = PDF::loadView('exports.shipments_pdf', ['shipments' => $shipments]);
        return $pdf->download('laporan_pengiriman.pdf');
    }

    // ✅ Export Pembayaran ke Excel
    public function exportPaymentExcel(Request $request)
    {
        return Excel::download(new PaymentsExport($request), 'laporan_pembayaran.xlsx');
    }

    // ✅ Export Pembayaran ke PDF
    public function exportPaymentPDF(Request $request)
    {
        $query = Payment::with('shipment')->where('IsDeleted', 0);

        if ($request->start_date) {
            $query->whereDate('CreatedDate', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('CreatedDate', '<=', $request->end_date);
        }

        $payments = $query->orderBy('CreatedDate', 'desc')->get();

        $pdf = PDF::loadView('exports.payments_pdf', ['payments' => $payments]);
        return $pdf->download('laporan_pembayaran.pdf');
    }
}
