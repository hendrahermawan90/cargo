@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- Memperbesar kolom untuk form -->
            <div class="col-md-10">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-primary text-white">
                        <h4>Tambah Order Baru</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan error jika ada -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form Input Order -->
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="customer_id" class="form-label">Pelanggan</label>
                                        <select name="customer_id" id="customer_id" class="form-select @error('customer_id') is-invalid @enderror">
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

                                    <div class="mb-3">
                                        <label for="tracking_number" class="form-label">Tracking Number</label>
                                        <input type="text" name="tracking_number" id="tracking_number" class="form-control @error('tracking_number') is-invalid @enderror" value="{{ old('tracking_number') }}">
                                        @error('tracking_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="origin" class="form-label">Origin</label>
                                        <input type="text" name="origin" id="origin" class="form-control @error('origin') is-invalid @enderror" value="{{ old('origin') }}"required>
                                        @error('origin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="destination" class="form-label">Destination</label>
                                        <input type="text" name="destination" id="destination" class="form-control @error('destination') is-invalid @enderror" value="{{ old('destination') }}" required>
                                        @error('destination')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Weight</label>
                                        <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" step="any" required>
                                        @error('weight')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="any">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="order_status" class="form-label">Status</label>
                                        <select name="order_status" id="order_status" class="form-select @error('order_status') is-invalid @enderror">
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
                                    <div class="mb-3">
                                        <label for="CompanyCode" class="form-label">Company Code</label>
                                        <input type="text" name="CompanyCode" id="CompanyCode" class="form-control @error('CompanyCode') is-invalid @enderror" value="{{ old('CompanyCode') }}">
                                        @error('CompanyCode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- <div class="mb-3">
                                        <label for="Status" class="form-label">Status</label>
                                        <select name="Status" id="Status" class="form-select @error('Status') is-invalid @enderror">
                                            <option value="0" {{ old('Status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            <option value="1" {{ old('Status') == '1' ? 'selected' : '' }}>Active</option>
                                        </select>
                                        @error('Status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> -->
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Simpan Order</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
