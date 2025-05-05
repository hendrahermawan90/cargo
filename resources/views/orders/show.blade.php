@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card Detail -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Order Details</h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="text-muted" style="width: 30%">🔢 Tracking Number</th>
                                <td>{{ $order->tracking_number }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Customer</th>
                                <td>{{ $order->customer->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">🌍 Origin</th>
                                <td>{{ $order->origin }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">🏁 Destination</th>
                                <td>{{ $order->destination }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">⚖️ Weight</th>
                                <td>{{ $order->weight }} kg</td>
                            </tr>
                            <tr>
                                <th class="text-muted">💰 Price</th>
                                <td>{{ number_format($order->price, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📦 Status</th>
                                <td>
                                    <span class="badge bg-{{ $order->order_status == 'paid' ? 'success' : ($order->order_status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">🏢 Company Code</th>
                                <td>{{ $order->CompanyCode ?? 'N/A' }}</td>
                            </tr>
                            <!-- <tr>
                                <th class="text-muted">🗑️ Is Deleted</th>
                                <td>{{ $order->IsDeleted == 1 ? 'Yes' : 'No' }}</td>
                            </tr> -->
                            <tr>
                                <th class="text-muted">👤 Created By</th>
                                <td>{{ $order->CreatedBy }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Created Date</th>
                                <td>{{ $order->CreatedDate }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">👤 Last Updated By</th>
                                <td>{{ $order->LastUpdatedBy }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">📅 Last Updated Date</th>
                                <td>{{ $order->LastUpdatedDate }}</td>
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
