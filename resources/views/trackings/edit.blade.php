@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Tracking</h2>

    <form action="{{ route('trackings.update', $tracking->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="shipment_id" class="form-label">Shipment</label>
            <select name="shipment_id" id="shipment_id" class="form-select" required>
                @foreach($shipments as $s)
                    <option value="{{ $s->id }}" {{ $tracking->shipment_id == $s->id ? 'selected' : '' }}>
                        {{ $s->tracking_number }} — {{ $s->receiver_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Pengiriman</label>
            <select name="status" id="status" class="form-select" required>
                @foreach($statusOptions as $value => $label)
                    <option value="{{ $value }}" {{ $tracking->status == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $tracking->location }}">
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Catatan</label>
            <textarea name="notes" id="notes" class="form-control">{{ $tracking->notes }}</textarea>
        </div>

        <div class="mb-3">
            <label for="proof_image" class="form-label">Ganti Bukti Foto (Opsional)</label>
            <input type="file" name="proof_image" id="proof_image" class="form-control" accept="image/*">
            @if($tracking->proof_image)
                <small class="d-block mt-1">Foto Saat Ini: <a href="{{ asset('storage/' . $tracking->proof_image) }}" target="_blank">Lihat</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('trackings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
