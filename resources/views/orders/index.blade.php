@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Orders</h2>
        
        <!-- Pesan Success -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Tombol untuk Menambah Order -->
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tambah Order Baru</a>
        
        <!-- Tabel Daftar Orders -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tracking Number</th>
                    <th>Pelanggan</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Status</th>
                    <th>Company Code</th>
                    <th>Status (Active/Inactive)</th>
                    <th>Is Deleted</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->tracking_number }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->origin }}</td>
                        <td>{{ $order->destination }}</td>
                        <td>{{ ucfirst($order->order_status) }}</td>
                        <td>{{ $order->CompanyCode ?? 'N/A' }}</td>
                        <td>{{ $order->Status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $order->IsDeleted == 1 ? 'Yes' : 'No' }}</td>
                        <td>
                            <!-- Tombol Show untuk melihat detail order -->
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Show</a>

                            <!-- Tombol Edit dan Hapus -->
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        {{ $orders->links() }}
    </div>
@endsection
