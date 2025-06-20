@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pengiriman</h2>

    <form action="{{ route('shipments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer Pengirim</label>
            <select name="customer_id" class="form-select" required>
                <option value="">Pilih Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sender_name" class="form-label">Nama Pengirim</label>
            <input type="text" name="sender_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sender_address" class="form-label">Alamat Pengirim</label>
            <textarea name="sender_address" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="receiver_name" class="form-label">Nama Penerima</label>
            <input type="text" name="receiver_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="receiver_address" class="form-label">Alamat Penerima</label>
            <textarea name="receiver_address" class="form-control" required></textarea>
        </div>

        <!-- Tambahkan input No. HP Penerima -->
        <div class="mb-3">
            <label for="receiver_phone" class="form-label">No. HP Penerima</label>
            <input type="text" name="receiver_phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat (kg)</label>
            <input type="number" step="0.01" name="weight" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
