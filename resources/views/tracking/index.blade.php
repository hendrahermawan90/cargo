@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">🔎 Cek Status Pengiriman</h3>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tracking.show', '') }}" method="GET" onsubmit="return redirectToTracking(event)">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" id="kodeResi" class="form-control" placeholder="Masukkan Kode Resi (contoh: SHP-123456)" required>
                    <button class="btn btn-primary" type="submit">Cek Resi</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function redirectToTracking(e) {
        e.preventDefault();
        const kode = document.getElementById("kodeResi").value.trim();
        if (kode) {
            window.location.href = "/tracking/" + encodeURIComponent(kode);
        }
        return false;
    }
</script>
@endsection
