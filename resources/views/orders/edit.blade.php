@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Order</h2>

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="customer_id">Pelanggan</label>
                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                    <option value="">Pilih Pelanggan</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tracking_number">Tracking Number</label>
                <input type="text" name="tracking_number" id="tracking_number" class="form-control @error('tracking_number') is-invalid @enderror" value="{{ old('tracking_number', $order->tracking_number) }}">
                @error('tracking_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" name="origin" id="origin" class="form-control @error('origin') is-invalid @enderror" value="{{ old('origin', $order->origin) }}">
                @error('origin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" name="destination" id="destination" class="form-control @error('destination') is-invalid @enderror" value="{{ old('destination', $order->destination) }}">
                @error('destination')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="weight">Weight</label>
                <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $order->weight) }}" step="any">
                @error('weight')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $order->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="order_status">Status</label>
                <select name="order_status" id="order_status" class="form-control @error('order_status') is-invalid @enderror">
                    <option value="pending" {{ old('order_status', $order->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('order_status', $order->order_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="shipped" {{ old('order_status', $order->order_status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ old('order_status', $order->order_status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ old('order_status', $order->order_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('order_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Add fields for CompanyCode, Status, and IsDeleted -->
            <div class="form-group">
                <label for="CompanyCode">Company Code</label>
                <input type="text" name="CompanyCode" id="CompanyCode" class="form-control @error('CompanyCode') is-invalid @enderror" value="{{ old('CompanyCode', $order->CompanyCode) }}">
                @error('CompanyCode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Status">Status</label>
                <select name="Status" id="Status" class="form-control @error('Status') is-invalid @enderror">
                    <option value="0" {{ old('Status', $order->Status) == '0' ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ old('Status', $order->Status) == '1' ? 'selected' : '' }}>Active</option>
                </select>
                @error('Status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="IsDeleted">Is Deleted</label>
                <select name="IsDeleted" id="IsDeleted" class="form-control @error('IsDeleted') is-invalid @enderror">
                    <option value="0" {{ old('IsDeleted', $order->IsDeleted) == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('IsDeleted', $order->IsDeleted) == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('IsDeleted')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Order</button>
        </form>
    </div>
@endsection
