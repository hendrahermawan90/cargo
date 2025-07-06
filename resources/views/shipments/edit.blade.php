@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengiriman</h2>

    <form action="{{ route('shipments.update', $shipment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select name="customer_id" class="form-select" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $customer->id == $shipment->customer_id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sender_name" class="form-label">Nama Pengirim</label>
            <input type="text" name="sender_name" class="form-control" value="{{ $shipment->sender_name }}" required>
        </div>

        <div class="mb-3">
            <label for="sender_address" class="form-label">Alamat Pengirim</label>
            <textarea name="sender_address" class="form-control" required>{{ $shipment->sender_address }}</textarea>
        </div>

        <div class="mb-3">
            <label for="receiver_name" class="form-label">Nama Penerima</label>
            <input type="text" name="receiver_name" class="form-control" value="{{ $shipment->receiver_name }}" required>
        </div>

        <div class="mb-3">
            <label for="receiver_address" class="form-label">Alamat Penerima</label>
            <textarea name="receiver_address" class="form-control" required>{{ $shipment->receiver_address }}</textarea>
        </div>

        <!-- Tambahkan input No. HP Penerima -->
        <div class="mb-3">
            <label for="receiver_phone" class="form-label">No. HP Penerima</label>
            <input type="text" name="receiver_phone" class="form-control" value="{{ $shipment->receiver_phone }}" required>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat (kg)</label>
            <input type="number" step="0.01" name="weight" class="form-control" value="{{ $shipment->weight }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                @foreach(\App\Models\Shipment::statusOptions() as $value => $label)
                    <option value="{{ $value }}" {{ $shipment->status === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
