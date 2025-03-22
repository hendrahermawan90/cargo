<!DOCTYPE html>
<html>
<head>
    <title>Track Your Shipment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Track Your Shipment</h1>
        <form action="{{ route('track') }}" method="GET">
            <div class="mb-3">
                <label for="tracking_number" class="form-label">Tracking Number</label>
                <input type="text" class="form-control" id="tracking_number" name="tracking_number" placeholder="Enter your tracking number" required>
            </div>
            <button type="submit" class="btn btn-primary">Track</button>
        </form>
    </div>
</body>
</html>
