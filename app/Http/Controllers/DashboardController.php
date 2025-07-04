<?php

namespace App\Http\Controllers;

use App\Models\Shipment;

class DashboardController extends Controller
{
    public function index()
{
    $totalShipments = Shipment::where('IsDeleted', 0)->count();
    $inTransit = Shipment::where('status', 'in_transit')->where('IsDeleted', 0)->count();
    $terkirim = Shipment::where('status', 'diterima')->where('IsDeleted', 0)->count();
    $revenue = Shipment::where('IsDeleted', 0)->sum('price');

    $recentShipments = Shipment::where('IsDeleted', 0)->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalShipments',
        'inTransit',
        'terkirim',
        'revenue',
        'recentShipments'
    ));
}

}
