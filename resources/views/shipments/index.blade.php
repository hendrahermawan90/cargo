@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Daftar Pengiriman
                        <a href="#" onclick="printTable()" class="btn btn-secondary float-end ms-2">Print</a>
                        <a href="{{ route('shipments.create') }}" class="btn btn-primary float-end">Tambah Pengiriman</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm align-middle text-nowrap">
                            <thead class="table-light text-center">
                                <tr>
                                    <th class="no-print">Aksi</th>
                                    <th>No</th>
                                    <th>No. Resi</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Customer</th>
                                    <th>Berat (kg)</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Dibuat Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shipments as $shipment)
                                    <tr>
                                        <td class="text-center no-print">
                                            <a href="{{ route('shipments.show', $shipment) }}" class="btn btn-outline-info btn-sm" title="Lihat"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('shipments.edit', $shipment) }}" class="btn btn-outline-primary btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm"
                                                title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal"
                                                data-id="{{ $shipment->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $shipment->tracking_number }}</td>
                                        <td>{{ $shipment->sender_name }}</td>
                                        <td>{{ $shipment->receiver_name }}</td>
                                        <td>{{ $shipment->customer->name ?? '-' }}</td>
                                        <td>{{ $shipment->weight }}</td>
                                        <td>{{ ucfirst($shipment->status) }}</td>
                                        <td>Rp {{ number_format($shipment->price, 0, ',', '.') }}</td>
                                        <td>{{ $shipment->CreatedBy ?? '-' }}</td>
                                        <td>{{ $shipment->CreatedDate ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="no-print">
                        {{ $shipments->links() }}
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
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data pengiriman ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script Modal -->
<script>
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const shipmentId = button.getAttribute('data-id');
        const form = document.getElementById('deleteForm');
        form.action = '/shipments/' + shipmentId;
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
        row.removeChild(row.children[0]);
    });

    const win = window.open('', '_blank');
    win.document.write(`
        <html>
        <head>
            <title>Daftar Pengiriman</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <style>
                body {
                    padding: 20px;
                    font-size: 12px;
                    font-family: Arial, sans-serif;
                }
                h4 {
                    text-align: center;
                    margin-bottom: 30px;
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
            <h4>Daftar Pengiriman</h4>
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
