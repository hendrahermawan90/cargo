<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tracking</title>
</head>
<body>
    <h2>Detail Pengiriman</h2>
    <p>Nomor Tracking: {{ $tracking->tracking_number }}</p>
    <p>Status: {{ $tracking->status }}</p>
    <a href="{{ route('track') }}">Cek Lagi</a>
</body>
</html>
