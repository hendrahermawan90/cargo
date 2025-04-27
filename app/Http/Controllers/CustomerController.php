<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Menampilkan daftar pelanggan dengan pagination
    public function index()
    {
        $customers = Customer::paginate(10);  // Mengambil data pelanggan dengan pagination (10 per halaman)
        return view('customers.index', compact('customers')); // Menampilkan data pelanggan di view 'customers.index'
    }

    // Menampilkan form untuk menambahkan customer baru
    public function create()
    {
        return view('customers.create'); // Menampilkan form untuk membuat customer baru
    }

    // Untuk store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'CompanyCode' => 'nullable|string|max:20',
            'Status' => 'required|in:0,1',  // Validasi untuk Status
            // 'IsDeleted' tidak diperlukan, jadi kita bisa menghapus baris validasi ini
        ]);

        // Menyimpan data pelanggan baru
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'CompanyCode' => $request->CompanyCode,
            'Status' => $request->Status,
            'IsDeleted' => $request->IsDeleted ?? 0,  // Nilai default 0 jika tidak ada nilai
            'CreatedBy' => auth()->user()->name,
            'CreatedDate' => now(),
            'LastUpdatedBy' => auth()->user()->name,
            'LastUpdatedDate' => now(),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }


    // Menampilkan form untuk mengedit data pelanggan
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer')); // Menampilkan form edit
    }

        // Untuk update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,  // Pengecualian untuk pelanggan yang sedang diedit
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'CompanyCode' => 'nullable|string|max:20',
            'Status' => 'required|in:0,1',
            // 'IsDeleted' tidak diperlukan, jadi kita bisa menghapus baris validasi ini
        ]);

        // Memperbarui data pelanggan
        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'CompanyCode' => $request->CompanyCode,
            'Status' => $request->Status,
            'IsDeleted' => $request->IsDeleted ?? 0,  // Nilai default 0 jika tidak ada nilai
            'LastUpdatedBy' => auth()->user()->name,
            'LastUpdatedDate' => now(),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    // Menghapus data pelanggan
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete(); // Menghapus data pelanggan

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }

    // Menampilkan detail pelanggan berdasarkan ID
    public function show($id)
    {
        // Mencari customer berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Menampilkan view untuk detail customer
        return view('customers.show', compact('customer'));
    }
}
