<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('include_deleted') == 'true') {
            $shipments = Shipment::withoutGlobalScope('not_deleted')
                ->with('customer')
                ->latest('CreatedDate')
                ->paginate(10);
        } else {
            $shipments = Shipment::with('customer')
                ->latest('CreatedDate')
                ->paginate(10);
        }

        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('shipments.create', compact('customers'));
    }

    protected function calculateDistance($origin, $destination)
    {
        $apiKey = config('services.google_maps.key');

        $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json", [
            'origins' => $origin,
            'destinations' => $destination,
            'key' => $apiKey,
        ]);

        $data = $response->json();
        \Log::info('Google Distance Matrix API response:', $data);

        if (
            isset($data['rows'][0]['elements'][0]['distance']['value']) &&
            $data['rows'][0]['elements'][0]['status'] === 'OK'
        ) {
            return $data['rows'][0]['elements'][0]['distance']['value'] / 1000; // meter ke km
        }

        return 0;
    }

    protected function calculatePrice($weight, $distance)
    {
        $basePrice = 5000;
        $pricePerKm = 1500;
        $pricePerKg = 2000;

        return $basePrice + ($distance * $pricePerKm) + ($weight * $pricePerKg);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'sender_name' => 'required|string|max:255',
            'sender_address' => 'required|string',
            'receiver_name' => 'required|string|max:255',
            'receiver_address' => 'required|string',
            'receiver_phone' => 'required|string|max:20',
            'weight' => 'required|numeric|min:0.1',
        ]);

        $distance = $this->calculateDistance($request->sender_address, $request->receiver_address);
        $price = $this->calculatePrice($request->weight, $distance);

        $shipment = new Shipment([
            'customer_id' => $request->customer_id,
            'sender_name' => $request->sender_name,
            'sender_address' => $request->sender_address,
            'receiver_name' => $request->receiver_name,
            'receiver_address' => $request->receiver_address,
            'receiver_phone' => $request->receiver_phone, // ✅ Tambahan penting
            'weight' => $request->weight,
        ]);

        $shipment->distance_km = $distance;
        $shipment->price = $price;
        $shipment->tracking_number = 'SHP-' . strtoupper(Str::random(10));
        $shipment->status = 'pending';
        $shipment->CreatedBy = Auth::user()->name ?? 'system';
        $shipment->CreatedDate = now();
        $shipment->IsDeleted = 0;

        $shipment->save();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment created successfully.');
    }

    public function show(Shipment $shipment)
    {
        $shipment->load('customer');
        return view('shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        $customers = Customer::all();
        return view('shipments.edit', compact('shipment', 'customers'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'sender_name' => 'required|string|max:255',
            'sender_address' => 'required|string',
            'receiver_name' => 'required|string|max:255',
            'receiver_address' => 'required|string',
            'receiver_phone' => 'required|string|max:20', // ✅ tambahkan validasi update
            'weight' => 'required|numeric|min:0.1',
            'status' => 'required|string|max:255',
        ]);

        $shipment->update([
            'customer_id' => $request->customer_id,
            'sender_name' => $request->sender_name,
            'sender_address' => $request->sender_address,
            'receiver_name' => $request->receiver_name,
            'receiver_address' => $request->receiver_address,
            'receiver_phone' => $request->receiver_phone, // ✅ tambahkan update
            'weight' => $request->weight,
            'status' => $request->status,
        ]);

        $distance = $this->calculateDistance($shipment->sender_address, $shipment->receiver_address);
        $price = $this->calculatePrice($shipment->weight, $distance);

        $shipment->distance_km = $distance;
        $shipment->price = $price;
        $shipment->LastUpdatedBy = Auth::user()->name ?? 'system';
        $shipment->LastUpdatedDate = now();
        $shipment->save();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment updated successfully');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->IsDeleted = 1;
        $shipment->LastUpdatedBy = Auth::user()->name ?? 'system';
        $shipment->LastUpdatedDate = now();
        $shipment->save();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment deleted successfully');
    }

    public function restore($id)
    {
        $shipment = Shipment::withoutGlobalScope('not_deleted')->findOrFail($id);
        $shipment->IsDeleted = 0;
        $shipment->LastUpdatedBy = Auth::user()->name ?? 'system';
        $shipment->LastUpdatedDate = now();
        $shipment->save();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment restored successfully');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
