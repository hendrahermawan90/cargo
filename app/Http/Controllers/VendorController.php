<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the vendors.
     */
    public function index()
    {
        // Mengambil semua vendor dari database dengan pagination
        $vendors = Vendor::paginate(10); // Mengambil 10 vendor per halaman
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new vendor.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created vendor in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Menyimpan vendor baru ke database
        Vendor::create($validated);

        // Redirect ke halaman vendor dan beri pesan sukses
        return redirect()->route('vendors.index')->with('success', 'Vendor added successfully');
    }

    /**
     * Display the specified vendor.
     */
    public function show($id)
    {
        // Menampilkan vendor berdasarkan ID
        $vendor = Vendor::findOrFail($id);
        return view('vendors.show', compact('vendor'));
    }
    

    /**
     * Show the form for editing the specified vendor.
     */
    public function edit($id)
    {
        // Menampilkan form untuk mengedit data vendor berdasarkan ID
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified vendor in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Menemukan vendor berdasarkan ID dan memperbarui data
        $vendor = Vendor::findOrFail($id);
        $vendor->update($validated);

        // Redirect ke halaman vendor dan beri pesan sukses
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully');
    }

    /**
     * Remove the specified vendor from storage.
     */
    public function destroy($id)
    {
        // Menghapus vendor berdasarkan ID
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        // Redirect ke halaman vendor dan beri pesan sukses
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully');
    }
}
