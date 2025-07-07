@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pembayaran</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="shipment_id" class="form-label">Pilih Shipment (No. Resi)</label>
            <select name="shipment_id" class="form-select" onchange="fillAmount()" required>
                <option value="">-- Pilih Shipment --</option>
                @foreach($shipments as $shipment)
                    <option value="{{ $shipment->id }}"
                        data-price="{{ $shipment->price }}">
                        {{ $shipment->tracking_number }} - {{ $shipment->receiver_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" class="form-select" required>
                <option value="">-- Pilih Metode --</option>
                <option value="cash">Cash</option>
                <option value="transfer">Transfer (Midtrans)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Pembayaran (Rp)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Bayar</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    function fillAmount() {
        const select = document.querySelector('select[name="shipment_id"]');
        const amountInput = document.querySelector('input[name="amount"]');
        const selectedOption = select.options[select.selectedIndex];
        amountInput.value = selectedOption?.dataset?.price || '';
    }
</script>
@endsection
