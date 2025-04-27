@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Order Baru</h2>
        
        <!-- Form Input Order -->
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="customer_id">Pelanggan</label>
                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                    <option value="">Pilih Pelanggan</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
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
                <input type="text" name="tracking_number" id="tracking_number" class="form-control @error('tracking_number') is-invalid @enderror" value="{{ old('tracking_number') }}">
                @error('tracking_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" name="origin" id="origin" class="form-control @error('origin') is-invalid @enderror" value="{{ old('origin') }}">
                @error('origin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" name="destination" id="destination" class="form-control @error('destination') is-invalid @enderror" value="{{ old('destination') }}">
                @error('destination')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="weight">Weight</label>
                <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" step="any">
                @error('weight')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="any">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="order_status">Status</label>
                <select name="order_status" id="order_status" class="form-control @error('order_status') is-invalid @enderror">
                    <option value="pending" {{ old('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('order_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="shipped" {{ old('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ old('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ old('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('order_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Field tambahan -->
            <div class="form-group">
                <label for="CompanyCode">Company Code</label>
                <input type="text" name="CompanyCode" id="CompanyCode" class="form-control @error('CompanyCode') is-invalid @enderror" value="{{ old('CompanyCode') }}">
                @error('CompanyCode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Status">Status (0 = Inactive, 1 = Active)</label>
                <select name="Status" id="Status" class="form-control @error('Status') is-invalid @enderror">
                    <option value="0" {{ old('Status') == '0' ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ old('Status') == '1' ? 'selected' : '' }}>Active</option>
                </select>
                @error('Status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="IsDeleted">Is Deleted (0 = No, 1 = Yes)</label>
                <select name="IsDeleted" id="IsDeleted" class="form-control @error('IsDeleted') is-invalid @enderror">
                    <option value="0" {{ old('IsDeleted') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('IsDeleted') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('IsDeleted')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan Order</button>
        </form>
    </div>
@endsection
