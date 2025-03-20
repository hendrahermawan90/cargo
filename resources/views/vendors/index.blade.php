@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Vendors
                        <a href="{{ route('vendors.create') }}" class="btn btn-primary float-end">Add New Vendor</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->contact }}</td>
                                    <td>{{ $vendor->status }}</td>
                                    <td>
                                        <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
