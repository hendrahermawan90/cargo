<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function show($kode)
    {
        $shipment = Shipment::where('tracking_number', $kode)->first();

        if (!$shipment) {
            return redirect()->route('tracking.index')->with('error', 'Resi tidak ditemukan.');
        }

        return view('tracking.show', compact('shipment'));
    }

    public function updateStatus(Request $request, $kode)
    {
        $shipment = Shipment::where('tracking_number', $kode)->firstOrFail();
        $shipment->status = $request->status;
        $shipment->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }
}
