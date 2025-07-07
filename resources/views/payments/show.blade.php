@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card Detail Pembayaran -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Detail Pembayaran</h5>
                    <a href="{{ route('payments.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="text-muted" style="width: 30%">🔢 No. Resi</th>
                                <td>{{ $payment->shipment?->tracking_number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Customer</th>
                                <td>{{ $payment->shipment?->customer?->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📞 No. HP Customer</th>
                                <td>{{ $payment->shipment?->customer?->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📦 Pengirim</th>
                                <td>{{ $payment->shipment?->sender_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">🏠 Alamat Pengirim</th>
                                <td>{{ $payment->shipment?->sender_address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👥 Penerima</th>
                                <td>{{ $payment->shipment?->receiver_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📞 No. HP Penerima</th>
                                <td>{{ $payment->shipment?->receiver_phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📍 Alamat Penerima</th>
                                <td>{{ $payment->shipment?->receiver_address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">💳 Metode Pembayaran</th>
                                <td>{{ ucfirst($payment->payment_method) }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">💰 Jumlah</th>
                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📌 Status</th>
                                <td>
                                    @php
                                        $badge = match(strtolower($payment->status)) {
                                            'paid' => 'success',
                                            'pending' => 'secondary',
                                            'failed' => 'danger',
                                            default => 'dark'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ ucfirst($payment->status) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Dibuat Oleh</th>
                                <td>{{ $payment->CreatedBy ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Dibuat Tanggal</th>
                                <td>{{ $payment->CreatedDate ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Diubah Oleh</th>
                                <td>{{ $payment->LastUpdatedBy ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Diubah Tanggal</th>
                                <td>{{ $payment->LastUpdatedDate ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
