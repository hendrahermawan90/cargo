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
<<<<<<< HEAD
            <textarea name="sender_address" id="sender_address" class="form-control" required></textarea>
        </div>

        <div class="mt-2 mb-4">
            <label class="form-label">Peta Lokasi Pengirim</label>
            <iframe id="map_sender"
                width="100%"
                height="250"
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="">
            </iframe>
=======
            <textarea name="sender_address" class="form-control" required></textarea>
>>>>>>> 4450d003b90e556c54d346c935dc4d3adcd6af96
        </div>

        <div class="mb-3">
            <label for="receiver_name" class="form-label">Nama Penerima</label>
            <input type="text" name="receiver_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="receiver_address" class="form-label">Alamat Penerima</label>
<<<<<<< HEAD
            <textarea name="receiver_address" id="receiver_address" class="form-control" required></textarea>
        </div>

        <div class="mt-2 mb-4">
            <label class="form-label">Peta Lokasi Penerima</label>
            <iframe id="map_receiver"
                width="100%"
                height="250"
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="">
            </iframe>
        </div>

=======
            <textarea name="receiver_address" class="form-control" required></textarea>
        </div>

        <!-- Tambahkan input No. HP Penerima -->
>>>>>>> 4450d003b90e556c54d346c935dc4d3adcd6af96
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
<<<<<<< HEAD

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
=======
>>>>>>> 4450d003b90e556c54d346c935dc4d3adcd6af96
</div>
@endsection
