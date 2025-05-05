@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4>Customer Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $customer->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $customer->Status == 1 ? 'Active' : 'Inactive' }}</td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
