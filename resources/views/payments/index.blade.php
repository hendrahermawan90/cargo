@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Daftar Pembayaran
                        <a href="#" onclick="printTable()" class="btn btn-secondary float-end ms-2">Print</a>
                        <a href="{{ route('payments.create') }}" class="btn btn-primary float-end">Tambah Pembayaran</a>
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
                                    <th>Kode Pembayaran</th>
                                    <th>No. Tracking</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat Penerima</th>
                                    <th>Nama Pengirim</th>
                                    <th>Alamat Pengirim</th>
                                    <th>Metode</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td class="text-center no-print">
                                            <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-outline-info btn-sm" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <button type="button" 
                                                    class="btn btn-outline-danger btn-sm" 
                                                    title="Hapus"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#confirmDeleteModal"
                                                    data-id="{{ $payment->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            @if($payment->status === 'pending' && $payment->payment_method === 'transfer')
                                                <a href="{{ route('payments.pay', $payment->id) }}" class="btn btn-outline-success btn-sm mt-1">
                                                    <i class="bi bi-credit-card"></i> Bayar
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $payment->kode_pembayaran ?? '-' }}</td>
                                        <td>{{ $payment->shipment?->tracking_number ?? '-' }}</td>
                                        <td>{{ $payment->shipment?->receiver_name ?? '-' }}</td>
                                        <td>{{ $payment->shipment?->receiver_address ?? '-' }}</td>
                                        <td>{{ $payment->shipment?->sender_name ?? '-' }}</td>
                                        <td>{{ $payment->shipment?->sender_address ?? '-' }}</td>
                                        <td>{{ ucfirst($payment->payment_method) }}</td>
                                        <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td>
                                            @php
                                                $badge = match(strtolower($payment->status)) {
                                                    'pending' => 'secondary',
                                                    'paid' => 'success',
                                                    'failed' => 'danger',
                                                    default => 'dark'
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badge }}">{{ ucfirst($payment->status) }}</span>
                                        </td>
                                        <td>{{ $payment->CreatedDate }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Belum ada pembayaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="no-print mt-3">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
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
                    Apakah Anda yakin ingin menghapus data pembayaran ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script Delete Modal -->
<script>
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const form = document.getElementById('deleteForm');
        form.action = '/payments/' + id;
    });
</script>

<!-- Bootstrap JS + Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Print Script -->
<script>
function printTable() {
    const table = document.querySelector('.table').cloneNode(true);

    // Hapus kolom Aksi dari thead & tbody
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
            <title>Daftar Pembayaran</title>
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
            <h4>Daftar Pembayaran</h4>
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
