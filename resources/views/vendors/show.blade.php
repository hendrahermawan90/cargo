@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Vendor Details</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li><strong>Name:</strong> {{ $vendor->name }}</li>
                        <li><strong>Contact:</strong> {{ $vendor->contact }}</li>
                        <li><strong>Status:</strong> {{ $vendor->status }}</li>
                        <li><strong>Address:</strong> {{ $vendor->address ?? 'N/A' }}</li>
                        <li><strong>City:</strong> {{ $vendor->city ?? 'N/A' }}</li>
                        <li><strong>State:</strong> {{ $vendor->state ?? 'N/A' }}</li>
                        <li><strong>Postal Code:</strong> {{ $vendor->postal_code ?? 'N/A' }}</li>
                        <li><strong>Country:</strong> {{ $vendor->country ?? 'N/A' }}</li>
                        <li><strong>Email:</strong> {{ $vendor->email ?? 'N/A' }}</li>
                        <li><strong>Website:</strong> 
                            @if ($vendor->website)
                                <a href="{{ $vendor->website }}" target="_blank">{{ $vendor->website }}</a>
                            @else
                                N/A
                            @endif
                        </li>
                        <li><strong>Description:</strong> {{ $vendor->description ?? 'N/A' }}</li>
                    </ul>
                    <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Back to Vendor List</a>
                    <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary">Edit Vendor</a>
                    <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Vendor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
