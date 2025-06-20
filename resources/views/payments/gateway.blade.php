<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Transfer</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h3>Sedang memproses pembayaran...</h3>

    <script type="text/javascript">
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('payments.index') }}";
            },
            onPending: function(result) {
                alert("Menunggu pembayaran.");
                window.location.href = "{{ route('payments.index') }}";
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
                window.location.href = "{{ route('payments.index') }}";
            }
        });
    </script>
</body>
</html>
