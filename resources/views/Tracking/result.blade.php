<!-- filepath: resources/views/tracking/result.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tracking Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tracking Result</h1>
        <p><strong>Tracking Number:</strong> {{ $tracking_number }}</p>
        <p><strong>Status:</strong> {{ $status }}</p>
        <p><strong>Last Updated:</strong> {{ $updated_at }}</p>
    </div>
</body>
</html>