@extends('layouts.app') <!-- Pastikan menggunakan layout utama -->

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Pengiriman</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nomor Tracking</th>
                <th>Status</th>
                <th>Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report->tracking_number }}</td>
                <td>{{ $report->status }}</td>
                <td>{{ $report->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
