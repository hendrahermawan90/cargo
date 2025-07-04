<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $query = Tracking::with('shipment')->latest('CreatedDate');

        // Filter tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('CreatedDate', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Filter berdasarkan no. resi
        if ($request->filled('search')) {
            $query->whereHas('shipment', function ($q) use ($request) {
                $q->where('tracking_number', 'like', '%' . $request->search . '%');
            });
        }

        $trackings = $query->paginate(10)->withQueryString();

        return view('trackings.index', compact('trackings', 'request'));
    }


    public function create()
{
    $shipments = Shipment::where('IsDeleted', 0)->get();
    $statusOptions = \App\Models\Shipment::statusOptions();

    return view('trackings.create', compact('shipments', 'statusOptions'));
}

    public function store(Request $request)
    {
        $request->validate([
            'shipment_id' => 'required|exists:shipments,id',
            'status' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'proof_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('proofs', 'public');
        }

        Tracking::create([
            'shipment_id' => $request->shipment_id,
            'status' => $request->status,
            'location' => $request->location,
            'notes' => $request->notes,
            'proof_image' => $path,
            'CompanyCode' => 'DEFAULT',
            'IsDeleted' => 0,
            'CreatedBy' => Auth::user()->name ?? 'system',
            'CreatedDate' => now(),
        ]);

        // Otomatis update status shipment juga
        Shipment::where('id', $request->shipment_id)->update([
            'status' => $request->status,
            'LastUpdatedBy' => Auth::user()->name ?? 'system',
            'LastUpdatedDate' => now(),
        ]);

        return redirect()->route('trackings.index')->with('success', 'Tracking berhasil ditambahkan.');
    }

    public function show(Tracking $tracking)
    {
        return view('trackings.show', compact('tracking'));
    }

    public function destroy(Tracking $tracking)
    {
        $tracking->IsDeleted = 1;
        $tracking->save();

        return redirect()->route('trackings.index')->with('success', 'Tracking berhasil dihapus.');
    }


    public function formTrack()
    {
        return view('welcome'); // menampilkan halaman welcome biasa
    }

    // public function searchTrack(Request $request)
    // {
    //     $request->validate([
    //         'tracking_number' => 'required|string',
    //     ]);

    //     $shipment = \App\Models\Shipment::with('trackings')
    //         ->where('tracking_number', $request->tracking_number)
    //         ->first();

    //     return view('welcome', compact('shipment'));
    // }

    public function searchTrack(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        $shipment = Shipment::with('trackings')
            ->where('tracking_number', $request->tracking_number)
            ->first();

        if (!$shipment) {
            return redirect('/')->with('not_found', true);
        }

        return view('welcome', compact('shipment'));
    }

    public function edit(Tracking $tracking)
    {
        $shipments = Shipment::where('IsDeleted', 0)->get();
        $statusOptions = Shipment::statusOptions(); // Ambil enum status dari Shipment

        return view('trackings.edit', compact('tracking', 'shipments', 'statusOptions'));
    }

    public function update(Request $request, Tracking $tracking)
    {
        $request->validate([
            'shipment_id' => 'required|exists:shipments,id',
            'status' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'proof_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $tracking->proof_image;

        if ($request->hasFile('proof_image')) {
            // Hapus gambar lama jika ada
            if ($path && \Storage::disk('public')->exists($path)) {
                \Storage::disk('public')->delete($path);
            }

            // Upload gambar baru
            $path = $request->file('proof_image')->store('proofs', 'public');
        }

        $tracking->update([
            'shipment_id' => $request->shipment_id,
            'status' => $request->status,
            'location' => $request->location,
            'notes' => $request->notes,
            'proof_image' => $path,
            'LastUpdatedBy' => Auth::user()->name ?? 'system',
            'LastUpdatedDate' => now(),
        ]);

        // Update status shipment juga
        Shipment::where('id', $request->shipment_id)->update([
            'status' => $request->status,
            'LastUpdatedBy' => Auth::user()->name ?? 'system',
            'LastUpdatedDate' => now(),
        ]);

        return redirect()->route('trackings.index')->with('success', 'Tracking berhasil diperbarui.');
    }


}
