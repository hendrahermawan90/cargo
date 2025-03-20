@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Order</h2>
        
        <table class="table table-bordered">
            <tr>
                <th>Tracking Number</th>
                <td>{{ $order->tracking_number }}</td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td>{{ $order->customer->name }}</td>
            </tr>
            <tr>
                <th>Origin</th>
                <td>{{ $order->origin }}</td>
            </tr>
            <tr>
                <th>Destination</th>
                <td>{{ $order->destination }}</td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>{{ $order->weight }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>{{ number_format($order->price, 2, ',', '.') }}</td> <!-- Format harga dengan pemisah ribuan dan dua angka desimal -->
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($order->order_status) }}</td>
            </tr>
        </table>

        <a href="{{ route('orders.index') }}" class="btn btn-primary">Kembali ke Daftar Order</a>
    </div>
@endsection
