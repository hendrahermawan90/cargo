<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10); // Menampilkan daftar pelanggan dengan pagination
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create'); // Menampilkan form tambah pelanggan
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'Status' => 'required|boolean',
            'IsDeleted' => 'required|boolean',
        ]);

        // Simpan data pelanggan
        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
    }
}