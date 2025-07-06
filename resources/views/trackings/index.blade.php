@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        TRACKING
                        <a href="#" onclick="printTable()" class="btn btn-secondary float-end ms-2">Print</a>
                        <a href="{{ route('trackings.create') }}" class="btn btn-primary float-end">Tambah</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- FILTER FORM -->
                    <!-- FILTER FORM -->
                <form method="GET" action="" class="row g-2 align-items-end mb-3">
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Dari Tanggal">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="Sampai Tanggal">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari No Resi..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                            <a href="{{ route('trackings.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm align-middle text-nowrap">
                            <thead class="table-light text-center">
                                <tr>
                                    <th class="no-print">Aksi</th>
                                    <th>No</th>
                                    <th>No Resi</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Lokasi</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Dibuat Tanggal</th>
                                    <th>Diubah Oleh</th>
                                    <th>Diubah Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trackings as $index => $tracking)
                                    <tr>
                                        <td class="text-center no-print">
                                            <a href="{{ route('trackings.show', $tracking) }}" class="btn btn-outline-info btn-sm" title="Lihat"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('trackings.edit', $tracking) }}" class="btn btn-outline-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm"
                                                title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal"
                                                data-id="{{ $tracking->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </td>
                                        <td class="text-center">{{ $trackings->firstItem() + $index }}</td>
                                        <td>{{ $tracking->shipment->tracking_number ?? '-' }}</td>
                                        <td>{{ $tracking->shipment->sender_name ?? '-' }}</td>
                                        <td>{{ $tracking->shipment->receiver_name ?? '-' }}</td>
                                        <td>{{ $tracking->shipment->receiver_address ?? '-' }}</td>
                                        <td>{{ ucfirst($tracking->status) }}</td>
                                        <td>{{ $tracking->location ?? '-' }}</td>
                                        <td>{{ $tracking->CreatedBy ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tracking->CreatedDate)->format('d-m-Y H:i') }}</td>
                                        <!-- <td>{{ optional($tracking->shipment)->LastUpdatedBy ?? '-' }}</td> -->
                                        <td>{{ $tracking->shipment->LastUpdatedBy ?? '-' }}</td>
                                        <td>
                                            @if($tracking->shipment && $tracking->shipment->LastUpdatedDate)
                                                {{ \Carbon\Carbon::parse($tracking->shipment->LastUpdatedDate)->format('d-m-Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Belum ada data tracking.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="no-print">
                        {{ $trackings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data tracking ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script Modal Hapus -->
<script>
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const trackingId = button.getAttribute('data-id');
        const form = document.getElementById('deleteForm');
        form.action = '/trackings/' + trackingId;
    });
</script>


<!-- Script Print -->
<script>
function printTable() {
    const table = document.querySelector('.table').cloneNode(true);

    // Hapus kolom aksi
    const theadRow = table.querySelector('thead tr');
    if (theadRow) theadRow.removeChild(theadRow.children[0]);

    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => {
        if (row.children.length > 1) {
            row.removeChild(row.children[0]);
        }
    });

    // Ambil info filter dari URL
    const urlParams = new URLSearchParams(window.location.search);
    let filterInfo = '';
    if (urlParams.get('start_date') && urlParams.get('end_date')) {
        filterInfo += `<p><strong>Periode:</strong> ${urlParams.get('start_date')} s.d. ${urlParams.get('end_date')}</p>`;
    }
    if (urlParams.get('search')) {
        filterInfo += `<p><strong>No Resi:</strong> ${urlParams.get('search')}</p>`;
    }

    const win = window.open('', '_blank');
    win.document.write(`
        <html>
        <head>
            <title>Daftar Tracking</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <style>
                body {
                    padding: 20px;
                    font-size: 12px;
                    font-family: Arial, sans-serif;
                }
                h4 {
                    text-align: center;
                    margin-bottom: 10px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    font-size: 12px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 6px 8px;
                    text-align: left;
                    vertical-align: top;
                    max-width: 150px;
                    word-break: break-word;
                    white-space: nowrap;
                }
                .no-print-btn {
                    margin-bottom: 20px;
                    display: flex;
                    gap: 10px;
                    justify-content: center;
                }
                @media print {
                    .no-print-btn {
                        display: none !important;
                    }
                    @page {
                        size: A4 landscape;
                        margin: 1cm;
                    }
                }
            </style>
        </head>
        <body>
            <h4>Daftar Tracking Pengiriman</h4>
            ${filterInfo}
            <div class="no-print-btn">
                <button onclick="window.print()" class="btn btn-primary">Print</button>
                <button onclick="window.close()" class="btn btn-secondary">Kembali</button>
            </div>
            ${table.outerHTML}
        </body>
        </html>
    `);
    win.document.close();
}
</script>
@endsection
