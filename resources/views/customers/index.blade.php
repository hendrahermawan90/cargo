@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4>Customers
                            <a href="{{ route('customers.create') }}" class="btn btn-dark btn btn-success float-end">Add New Customer</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan success jika ada -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Tabel Daftar Customers -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th> <!-- Kolom No ditambahkan -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr>
                                            <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->Status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
