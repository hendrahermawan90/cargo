<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::latest()->paginate(10);
        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('shipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender_name' => 'required',
            'sender_address' => 'required',
            'receiver_name' => 'required',
            'receiver_address' => 'required',
            'weight' => 'required|numeric',
        ]);

        $shipment = new Shipment($request->all());
        $shipment->tracking_number = 'SHP-' . strtoupper(Str::random(10));
        $shipment->save();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment created successfully.');
    }

    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        return view('shipments.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'sender_name' => 'required',
            'sender_address' => 'required',
            'receiver_name' => 'required',
            'receiver_address' => 'required',
            'weight' => 'required|numeric',
            'status' => 'required',
        ]);

        $shipment->update($request->all());

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment updated successfully');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment deleted successfully');
    }
}
