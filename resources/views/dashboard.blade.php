@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Dashboard</h4>

    <!-- Statistic Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Total Pengiriman</div>
                        <h4 class="fw-bold mb-0">{{ number_format($totalShipments) }}</h4>
                    </div>
                    <i class="bi bi-box fs-2 text-primary"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Dalam Perjalanan</div>
                        <h4 class="fw-bold mb-0">{{ number_format($inTransit) }}</h4>
                    </div>
                    <i class="bi bi-truck fs-2 text-warning"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Terkirim</div>
                        <h4 class="fw-bold mb-0">{{ number_format($terkirim) }}</h4>
                    </div>
                    <i class="bi bi-check-circle fs-2 text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Total Pendapatan</div>
                        <h4 class="fw-bold mb-0">Rp {{ number_format($revenue, 0, ',', '.') }}</h4>
                    </div>
                    <i class="bi bi-cash-stack fs-2 text-success"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Shipments Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Pengiriman Terbaru</h5>
            <a href="{{ route('shipments.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-right"></i> Lihat Semua
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No. Resi</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentShipments as $shipment)
                            <tr>
                                <td>{{ $shipment->tracking_number }}</td>
                                <td>{{ $shipment->sender_name }}</td>
                                <td>{{ $shipment->receiver_name }}</td>
                                <td>
                                    @php
                                        $badge = match(strtolower($shipment->status)) {
                                            'pending' => 'danger',
                                            'in_transit' => 'warning',
                                            'diterima', 'delivered' => 'success',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ ucfirst($shipment->status) }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($shipment->CreatedDate)->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('shipments.show', $shipment) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data pengiriman terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
