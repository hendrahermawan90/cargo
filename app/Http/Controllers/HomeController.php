<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $shipment = null;

        if ($request->isMethod('post')) {
            $request->validate([
                'tracking_number' => 'required|string',
            ]);

            $shipment = Shipment::with('trackings')
                ->where('tracking_number', $request->tracking_number)
                ->first();

            if (!$shipment) {
                return view('welcome')->with('not_found', true);
            }
        }

        return view('welcome', compact('shipment'));
    }
}
