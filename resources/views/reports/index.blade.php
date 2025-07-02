@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary fw-bold">
        <i class="fas fa-file-alt me-2"></i>Laporan
    </h3>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column align-items-start">
                    <h5 class="card-title">
                        <i class="fas fa-shipping-fast text-primary me-2"></i>Laporan Pengiriman
                    </h5>
                    <p class="card-text text-muted">Lihat semua data pengiriman berdasarkan tanggal atau ekspedisi.</p>
                    <a href="{{ route('reports.shipments') }}" class="btn btn-outline-primary mt-auto">
                        <i class="fas fa-eye me-1"></i> Lihat Laporan
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column align-items-start">
                    <h5 class="card-title">
                        <i class="fas fa-money-check-alt text-success me-2"></i>Laporan Pembayaran
                    </h5>
                    <p class="card-text text-muted">Tinjau transaksi pembayaran yang telah dilakukan pelanggan.</p>
                    <a href="{{ route('reports.payments') }}" class="btn btn-outline-success mt-auto">
                        <i class="fas fa-eye me-1"></i> Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
