@extends('layouts.app')

@section('content')

<style>
    @media print {
        nav, .sidebar, .btn, form, footer {
            display: none !important;
        }

        body {
            font-size: 12px;
            color: #000;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse !important;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000 !important;
            padding: 6px;
            text-align: left;
        }

        h3 {
            text-align: center;
            margin-bottom: 0;
        }

        .print-header {
            text-align: center;
            margin-bottom: 10px;
        }
    }
</style>

<div class="container py-4">
    <div class="print-header">
        <h3 class="mb-0 fw-bold">Laporan Pengiriman</h3>
        @if(request('start_date') && request('end_date'))
            <p>Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}</p>
        @endif
    </div>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <button type="button" onclick="window.print()" class="btn btn-outline-secondary">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </form>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Kode Pengiriman</th>
                    <th>Nama Penerima</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($shipments as $shipment)
                    <tr>
                        <td>{{ $shipment->tracking_number }}</td>
                        <td>{{ $shipment->receiver_name }}</td>
                        <td>{{ $shipment->status }}</td>
                        <td>
                            {{ $shipment->CreatedDate 
                                ? \Carbon\Carbon::parse($shipment->CreatedDate)->format('d-m-Y') 
                                : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data pengiriman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
