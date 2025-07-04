@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Tracking</h2>

    <form action="{{ route('trackings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="shipment_id" class="form-label">Pilih Shipment</label>
            <select name="shipment_id" id="shipment_id" class="form-select" required>
                <option value="">-- Pilih Shipment --</option>
                @foreach($shipments as $s)
                    <option value="{{ $s->id }}" {{ old('shipment_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->tracking_number }} — {{ $s->receiver_name }}
                    </option>
                @endforeach
            </select>
            @error('shipment_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Pengiriman</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Pilih Status --</option>
                @foreach($statusOptions as $value => $label)
                    <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" placeholder="Kota/Gudang">
            @error('location') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Catatan</label>
            <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Keterangan tambahan">{{ old('notes') }}</textarea>
            @error('notes') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="proof_image" class="form-label">Bukti Foto</label>
            <input type="file" name="proof_image" id="proof_image" class="form-control" accept="image/*">
            @error('proof_image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Tracking</button>
        <a href="{{ route('trackings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
