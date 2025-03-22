<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Tracking</title>
</head>
<body>
    <h2>Masukkan Nomor Tracking</h2>
    <form action="{{ route('tracking.track', ['tracking_number' => '']) }}" method="GET">
        <input type="text" name="tracking_number" placeholder="Masukkan nomor tracking" required>
        <button type="submit">Cek</button>
    </form>
</body>
</html>
