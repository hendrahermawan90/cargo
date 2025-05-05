@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-primary text-white">
                        <h4>Orders
                            <a href="{{ route('orders.create') }}" class="btn btn-dark btn-success float-end">Add New Order</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan success jika ada -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Tabel Daftar Orders -->
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tracking Number</th>
                                    <th>Customer</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Status</th>
                                    <th>Company Code</th>
                                    <th>Actions</th>
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
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
