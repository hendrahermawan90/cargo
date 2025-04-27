@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Customers</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add New Customer</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->Status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">View</a>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $customers->links() }}
    </div>
@endsection