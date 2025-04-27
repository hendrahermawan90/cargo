@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Orders
                            <a href="{{ route('orders.create') }}" class="btn btn-primary float-end">Add New Order</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan success jika ada -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Tabel Daftar Orders -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tracking Number</th>
                                    <th>Customer</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Status</th>
                                    <th>Company Code</th>
                                    <!-- <th>Status (Active/Inactive)</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->tracking_number }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->origin }}</td>
                                        <td>{{ $order->destination }}</td>
                                        <td>{{ ucfirst($order->order_status) }}</td>
                                        <td>{{ $order->CompanyCode ?? 'N/A' }}</td>
                                        <!-- <td>{{ $order->Status == 1 ? 'Active' : 'Inactive' }}</td> -->
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal"
                                                    data-id="{{ $order->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $orders->links() }}
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
                            Apakah Anda yakin ingin menghapus data order ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>

            <script>
                const deleteModal = document.getElementById('confirmDeleteModal');
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const orderId = button.getAttribute('data-id');
                    const form = document.getElementById('deleteForm');
                    form.action = '/orders/' + orderId;
                });
            </script>


<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
