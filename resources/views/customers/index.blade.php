@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Customers
                            <a href="#" onclick="printTable()" class="btn btn-secondary float-end me-2">Print</a>
                            <a href="{{ route('customers.create') }}" class="btn btn-primary float-end me-2">Add New Customer</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan success jika ada -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Tabel Daftar Customers -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th class="no-print">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $index => $customer)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->Status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td class="no-print">
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal"
                                                    data-id="{{ $customer->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="no-print">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data customer ini?
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
            const customerId = button.getAttribute('data-id');
            const form = document.getElementById('deleteForm');
            form.action = '/customers/' + customerId;
        });
    </script>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Print -->
    <script>
        function printTable() {
            const printContents = document.querySelector('.card-body').innerHTML;
            const originalContents = document.body.innerHTML;
            const originalTitle = document.title;

            // Set title khusus untuk print
            document.title = "Daftar Customers";

            document.body.innerHTML = `
                <html>
                <head>
                    <title>Daftar Customers</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
                    <style>
                        @media print {
                            .no-print {
                                display: none !important;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="container mt-4">
                        ${printContents}
                    </div>
                </body>
                </html>
            `;

            window.print();

            // Kembalikan isi & title asli
            document.body.innerHTML = originalContents;
            document.title = originalTitle;
            location.reload();
        }
    </script>

    <!-- Hide actions & buttons in print -->
    <style>
        @media print {
            .no-print,
            .btn,
            .pagination {
                display: none !important;
            }
        }
    </style>
@endsection
