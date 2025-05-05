<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan form untuk membuat order baru
    public function create()
    {
        $customers = Customer::all(); // Ambil semua pelanggan untuk dropdown
        return view('orders.create', compact('customers')); // Mengirim data pelanggan ke view
    }

    // Menyimpan data order baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tracking_number' => 'required|string|max:255',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'order_status' => 'required|in:pending,paid,shipped,delivered,cancelled',
            'CompanyCode' => 'nullable|string|max:20',
            // 'Status' => 'required|in:0,1',
            //'IsDeleted' => 'required|in:0,1',
        ]);

        // Simpan order baru
        Order::create([
            'customer_id' => $request->customer_id,
            'tracking_number' => $request->tracking_number,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'price' => $request->price,
            'order_status' => $request->order_status,
            'CompanyCode' => $request->CompanyCode,
            // 'Status' => $request->Status,
            'IsDeleted' => $request->IsDeleted ?? 0,
            'CreatedBy' => Auth::user()->name,
            'CreatedDate' => now(),
            'LastUpdatedBy' => Auth::user()->name,
            'LastUpdatedDate' => now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    // Menampilkan daftar pesanan dengan pagination
    public function index()
    {
        $orders = Order::with('customer')->paginate(10); 
        return view('orders.index', compact('orders')); 
    }

    // Menampilkan detail order
    public function show($id)
    {
        // Mengambil order berdasarkan ID
        $order = Order::findOrFail($id); // Jika tidak ditemukan, akan memberikan 404 error
        return view('orders.show', compact('order')); // Mengirim data order ke view 'orders.show'
    }

    // Menampilkan form untuk mengedit order
    public function edit($id)
    {
        // Mengambil order berdasarkan ID dan semua pelanggan
        $order = Order::findOrFail($id); // Jika order tidak ditemukan, akan menghasilkan 404 error
        $customers = Customer::all(); // Ambil semua data pelanggan untuk dropdown
        return view('orders.edit', compact('order', 'customers')); // Mengirim data order dan pelanggan ke view 'orders.edit'
    }

    // Memperbarui data order
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tracking_number' => 'required|string|max:255',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'order_status' => 'required|in:pending,paid,shipped,delivered,cancelled',
            'CompanyCode' => 'nullable|string|max:20',
            // 'Status' => 'required|in:0,1',
            // 'IsDeleted' => 'required|in:0,1',
        ]);

        // Cari dan update order berdasarkan ID
        $order = Order::findOrFail($id);
        $order->update([
            'customer_id' => $request->customer_id,
            'tracking_number' => $request->tracking_number,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'price' => $request->price,
            'order_status' => $request->order_status,
            'CompanyCode' => $request->CompanyCode,
            // 'Status' => $request->Status,
            'IsDeleted' => $request->IsDeleted ?? 0,
            'LastUpdatedBy' => Auth::user()->name,
            'LastUpdatedDate' => now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    // Menghapus order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete(); // Hapus order

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
