<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;

class ResiController extends Controller
{
    public function cetak(Shipment $shipment)
    {
        // Eager load relasi payment agar data pembayaran langsung tersedia
        $shipment->load('payment');

        return view('resi.cetak', compact('shipment'));
    }
    
}
