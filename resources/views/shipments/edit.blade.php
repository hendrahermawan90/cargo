@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengiriman</h2>

    <form action="{{ route('shipments.update', $shipment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Kolom Kiri: Pengirim -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer Pengirim</label>
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
                    <textarea name="sender_address" id="sender_address" class="form-control" required>{{ $shipment->sender_address }}</textarea>
                </div>

                <!-- Peta Lokasi Pengirim -->
                <div class="mb-3">
                    <label class="form-label">📍 Lokasi Pengirim</label>
                    <div class="rounded shadow-sm overflow-hidden" style="height: 250px;">
                        <iframe id="map_sender"
                            width="100%"
                            height="100%"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q={{ urlencode($shipment->sender_address) }}&output=embed">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Penerima -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="receiver_name" class="form-label">Nama Penerima</label>
                    <input type="text" name="receiver_name" class="form-control" value="{{ $shipment->receiver_name }}" required>
                </div>

                <div class="mb-3">
                    <label for="receiver_address" class="form-label">Alamat Penerima</label>
                    <textarea name="receiver_address" id="receiver_address" class="form-control" required>{{ $shipment->receiver_address }}</textarea>
                </div>

                <!-- Peta Lokasi Penerima -->
                <div class="mb-3">
                    <label class="form-label">📍 Lokasi Penerima</label>
                    <div class="rounded shadow-sm overflow-hidden" style="height: 250px;">
                        <iframe id="map_receiver"
                            width="100%"
                            height="100%"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q={{ urlencode($shipment->receiver_address) }}&output=embed">
                        </iframe>
                    </div>
                </div>

                <!-- No. HP Penerima -->
                <div class="mb-3">
                    <label for="receiver_phone" class="form-label">No. HP Penerima</label>
                    <input type="text" name="receiver_phone" class="form-control" value="{{ $shipment->receiver_phone }}" required>
                </div>
            </div>
        </div>

        <!-- Berat dan Status -->
        <div class="row mt-4">
            <div class="col-md-6">
                <label for="weight" class="form-label">Berat (kg)</label>
                <input type="number" step="0.01" name="weight" class="form-control" value="{{ $shipment->weight }}" required>
            </div>

            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="pending" {{ $shipment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_transit" {{ $shipment->status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                    <option value="delivered" {{ $shipment->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function updateMap(inputId, iframeId) {
                const input = document.getElementById(inputId);
                const iframe = document.getElementById(iframeId);

                input.addEventListener("input", function () {
                    const address = encodeURIComponent(input.value);
                    iframe.src = `https://www.google.com/maps?q=${address}&output=embed`;
                });
            }

            updateMap("sender_address", "map_sender");
            updateMap("receiver_address", "map_receiver");
        });
    </script>
</div>
@endsection
