<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tracking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Tracking</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Tracking</th>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Waktu Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trackings as $key => $tracking)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $tracking->tracking_number }}</td>
                    <td>{{ $tracking->order_id }}</td>
                    <td>{{ $tracking->status }}</td>
                    <td>{{ $tracking->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $trackings->links() }} <!-- Pagination -->
    </div>
</body>
</html>
