@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">🔍 Detail Tracking: {{ $shipment->tracking_number }}</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>📦 Informasi Pengirim</h5>
                    <p><strong>Nama:</strong> {{ $shipment->sender_name }}</p>
                    <p><strong>Alamat:</strong> {{ $shipment->sender_address }}</p>
                </div>
                <div class="col-md-6">
                    <h5>📬 Informasi Penerima</h5>
                    <p><strong>Nama:</strong> {{ $shipment->receiver_name }}</p>
                    <p><strong>Alamat:</strong> {{ $shipment->receiver_address }}</p>
                    <p><strong>No. HP:</strong> {{ $shipment->receiver_phone }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <p><strong>Berat:</strong> {{ $shipment->weight }} kg</p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Status:</strong>
                        <span class="badge 
                            {{ $shipment->status == 'pending' ? 'bg-warning' : ($shipment->status == 'in_transit' ? 'bg-info' : 'bg-success') }}">
                            {{ ucfirst($shipment->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-4">
                    <p><strong>Tracking Code:</strong> {{ $shipment->tracking_number }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Update Status --}}
    <div class="card">
        <div class="card-header">
            Update Status Pengiriman
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tracking.updateStatus', $shipment->tracking_number) }}">
                @csrf
                <div class="mb-3">
                    <label for="status" class="form-label">Status Baru</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" {{ $shipment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_transit" {{ $shipment->status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                        <option value="delivered" {{ $shipment->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                </div>
                <button class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
