<!DOCTYPE html>
<html>
<head>
    <title>Resi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            font-size: 12px;
            margin: 0;
            padding: 2rem;
        }
        .card-resi {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            border: 1px solid #dee2e6;
        }
        h5 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
            font-size: 16px;
            color: #0d6efd;
        }
        .info-group {
            margin-bottom: 14px;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            display: inline-block;
            width: 130px;
        }
        .section-title {
            font-weight: 600;
            font-size: 12px;
            margin-top: 22px;
            margin-bottom: 10px;
            color: #343a40;
            border-bottom: 1px dashed #ced4da;
            padding-bottom: 4px;
        }
        @media print {
            @page { size: A5 portrait; margin: 1cm; }
            body { background: white; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="card-resi">
        <h5>RESI PEMBAYARAN PENGIRIMAN</h5>

        <!-- Info Umum -->
        <div class="info-group"><span class="info-label">No. Resi:</span> {{ $shipment->tracking_number }}</div>
        <div class="info-group"><span class="info-label">Tanggal Buat:</span> {{ \Carbon\Carbon::parse($shipment->CreatedDate)->format('d-m-Y H:i') }}</div>

        <!-- Pengirim -->
        <div class="section-title">Pengirim</div>
        <div class="info-group"><span class="info-label">Nama:</span> {{ $shipment->sender_name }}</div>
        <div class="info-group"><span class="info-label">Alamat:</span> {{ $shipment->sender_address }}</div>

        <!-- Penerima -->
        <div class="section-title">Penerima</div>
        <div class="info-group"><span class="info-label">Nama:</span> {{ $shipment->receiver_name }}</div>
        <div class="info-group"><span class="info-label">Alamat:</span> {{ $shipment->receiver_address }}</div>
        <div class="info-group"><span class="info-label">Telepon:</span> {{ $shipment->receiver_phone ?? '-' }}</div>

        <!-- Pembayaran -->
        <div class="section-title">Detail Pembayaran</div>
        <div class="info-group"><span class="info-label">Status:</span> {{ ucfirst($shipment->payment->status ?? '-') }}</div>
        <div class="info-group"><span class="info-label">Metode:</span> {{ ucfirst($shipment->payment->payment_method ?? '-') }}</div>
        <div class="info-group"><span class="info-label">Total Bayar:</span> Rp {{ number_format($shipment->payment->amount ?? 0, 0, ',', '.') }}</div>
        <div class="info-group"><span class="info-label">Dibayar Pada:</span> 
            {{ $shipment->payment->paid_at ? \Carbon\Carbon::parse($shipment->payment->paid_at)->format('d-m-Y H:i') : '-' }}
        </div>

        <!-- Dibuat Oleh -->
        <div class="section-title">Dibuat Oleh</div>
        <div class="info-group"><span class="info-label">User:</span> {{ $shipment->payment->CreatedBy ?? 'Tidak diketahui' }}</div>
    </div>

    <!-- Tombol -->
    <div class="no-print mt-4 text-center">
        <button onclick="window.print()" class="btn btn-sm btn-primary">Print Resi</button>
        <button onclick="window.close()" class="btn btn-sm btn-secondary">Tutup</button>
    </div>

</body>
</html>
