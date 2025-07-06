@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card Detail -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Customer Details</h5>
                    <a href="{{ route('customers.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="text-muted" style="width: 30%">👤 Nama</th>
                                <td>{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📧 Email</th>
                                <td>{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📱 Telepon</th>
                                <td>{{ $customer->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">🏠 Alamat</th>
                                <td>{{ $customer->address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📌 Status</th>
                                <td>
                                    @if ($customer->Status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">🏢 Company Code</th>
                                <td>{{ $customer->CompanyCode ?? 'N/A' }}</td>
                            </tr>
                            <!-- <tr>
                                <th class="text-muted">🗑️ Is Deleted</th>
                                <td>{{ $customer->IsDeleted == 1 ? 'Yes' : 'No' }}</td>
                            </tr> -->
                            <tr>
                                <th class="text-muted">👤 Dibuat Oleh</th>
                                <td>{{ $customer->CreatedBy }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Dibuat Tanggal</th>
                                <td>{{ $customer->CreatedDate }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Diubah Oleh</th>
                                <td>{{ $customer->LastUpdatedBy }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Diubah Tanggal</th>
                                <td>{{ $customer->LastUpdatedDate }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Tambahkan Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
