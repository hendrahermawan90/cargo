@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card Detail Tracking -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-truck me-2"></i>Detail Tracking</h5>
                    <a href="{{ route('trackings.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="text-muted" style="width: 30%">🔢 Tracking Number</th>
                                <td>{{ $tracking->shipment->tracking_number }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Customer</th>
                                <td>{{ $tracking->shipment->customer->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📞 No. HP Customer</th>
                                <td>{{ $tracking->shipment->customer->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📦 Pengirim</th>
                                <td>{{ $tracking->shipment->sender_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">🏠 Alamat Pengirim</th>
                                <td>{{ $tracking->shipment->sender_address }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👥 Penerima</th>
                                <td>{{ $tracking->shipment->receiver_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📞 No. HP Penerima</th>
                                <td>{{ $tracking->shipment->receiver_phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📍 Alamat Penerima</th>
                                <td>{{ $tracking->shipment->receiver_address }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">⚖️ Berat</th>
                                <td>{{ $tracking->shipment->weight }} kg</td>
                            </tr>
                            <tr>
                                <th class="text-muted">💰 Harga</th>
                                <td>Rp {{ number_format($tracking->shipment->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📌 Status Tracking Ini</th>
                                <td>{{ ucfirst($tracking->status) }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">🗺️ Lokasi</th>
                                <td>{{ $tracking->location ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📝 Catatan</th>
                                <td>{{ $tracking->notes ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Dibuat Oleh</th>
                                <td>{{ $tracking->CreatedBy ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Dibuat Tanggal</th>
                                <td>{{ $tracking->CreatedDate ? \Carbon\Carbon::parse($tracking->CreatedDate)->format('d-m-Y H:i') : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Diupdate Oleh</th>
                                <td>{{ $tracking->shipment->LastUpdatedBy ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Diupdate Tanggal</th>
                                <td>{{ $tracking->shipment->LastUpdatedDate ? \Carbon\Carbon::parse($tracking->shipment->LastUpdatedDate)->format('d-m-Y H:i') : '-' }}</td>
                            </tr>
                            @if($tracking->proof_image)
                            <tr>
                                <th class="text-muted">📷 Bukti Foto</th>
                                <td>
                                    <img src="{{ asset('storage/' . $tracking->proof_image) }}" alt="Bukti Foto" class="img-fluid rounded border" style="max-width: 300px;">
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Riwayat Tracking -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Tracking</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($tracking->shipment->trackings as $log)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <strong>{{ \Carbon\Carbon::parse($log->CreatedDate)->format('d-m-Y H:i') }}</strong><br>
                                {{ $log->status }} di {{ $log->location }}<br>
                                @if($log->notes)
                                    <small class="text-muted">{{ $log->notes }}</small><br>
                                @endif
                            </div>
                            @if($log->proof_image)
                                <a href="{{ asset('storage/' . $log->proof_image) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $log->proof_image) }}" alt="Bukti" class="rounded" style="height:60px; object-fit:cover;">
                                </a>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">
                            Belum ada riwayat tracking untuk pengiriman ini.
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
