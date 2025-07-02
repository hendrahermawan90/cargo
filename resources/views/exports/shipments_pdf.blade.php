<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengiriman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h4 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h4>Laporan Pengiriman</h4>
    <table>
        <thead>
            <tr>
                <th>Kode Pengiriman</th>
                <th>Nama Penerima</th>
                <th>Status</th>
                <th>Tanggal Dikirim</th>
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
            <td colspan="4" style="text-align: center;">Tidak ada data pengiriman</td>
        </tr>
    @endforelse
</tbody>

    </table>
</body>
</html>
