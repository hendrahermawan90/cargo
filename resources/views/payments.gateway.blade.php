<button id="pay-button">Bayar Sekarang</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                alert('Pembayaran berhasil!');
            },
            onPending: function (result) {
                alert('Menunggu pembayaran...');
            },
            onError: function (result) {
                alert('Pembayaran gagal!');
            },
            onClose: function () {
                alert('Kamu belum menyelesaikan pembayaran.');
            }
        });
    };
</script>
