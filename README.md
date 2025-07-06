# 🚚 Cargo – Aplikasi Web Manajemen Pengiriman Barang

**Cargo** adalah aplikasi web berbasis Laravel yang dikembangkan oleh **Kelompok 5** untuk membantu perusahaan logistik maupun pengguna individu dalam mengelola proses pengiriman barang secara efisien dan modern.

Aplikasi ini hadir dengan fitur pelacakan real-time, manajemen pengguna berbasis peran, otentikasi Google, pembayaran online melalui Midtrans, pencetakan resi otomatis, serta dashboard statistik yang informatif.

---

## ✨ Fitur Unggulan

* 📦 **Manajemen Pengiriman**
  Buat, ubah, dan kelola data pengiriman barang secara dinamis, lengkap dengan status pengiriman: *pending*, *dikemas*, *dikirim*, *in transit*, *tiba di tujuan*, *delivered*, *gagal dikirim*, dan *dikembalikan*.

* 🗺️ **Pelacakan Pengiriman (Tracking)**
  Lacak status dan histori pengiriman barang menggunakan kode resi unik, lengkap dengan bukti pengiriman berupa foto.

* 👥 **Manajemen Pengguna & Pelanggan**
  Akses berbasis peran (*admin*, *kurir*, dan *pelanggan*) dengan otorisasi yang disesuaikan dengan kebutuhan masing-masing peran.

* 🔐 **Login dengan Google**
  Otentikasi cepat dan aman melalui Google menggunakan Laravel Socialite.

* 💳 **Pembayaran Online via Midtrans**
  Mendukung sistem pembayaran digital menggunakan Midtrans (Snap API), memudahkan pengguna dalam melakukan pembayaran ongkir secara aman dan terverifikasi.

* 📊 **Dashboard Admin Interaktif**
  Menyajikan data statistik seperti jumlah pengiriman, status paket, transaksi pembayaran, dan aktivitas pengguna secara real-time.

* 🧾 **Cetak Resi & Laporan PDF**
  Otomatisasi pencetakan resi dan laporan pengiriman dalam format PDF berdasarkan filter tanggal dan status.

* 📱 **Desain Responsif & Mobile-Friendly**
  Tampilan antarmuka yang optimal di berbagai perangkat, mulai dari desktop hingga ponsel.

---

## 🔗 Integrasi Midtrans

Untuk mengaktifkan Midtrans sebagai metode pembayaran:

1. Buat akun di [Midtrans Dashboard](https://dashboard.midtrans.com/).

2. Aktifkan mode sandbox/test dan ambil `SERVER_KEY` dan `CLIENT_KEY`.

3. Tambahkan kredensial ke file `.env` aplikasi:

   ```
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_IS_PRODUCTION=false
   ```

4. Sistem akan mengarahkan pengguna ke halaman pembayaran Midtrans (Snap) setelah pengiriman dibuat dan biaya dihitung.

---

## 🔒 Integrasi Google Login

Untuk mengaktifkan Google Login:

1. Daftarkan aplikasi Anda di [Google Cloud Console](https://console.cloud.google.com/).
2. Aktifkan OAuth 2.0.
3. Masukkan `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, dan `GOOGLE_REDIRECT_URI` pada file `.env`.

---

## 👨‍💻 Dibuat oleh – Kelompok 5

> Kami adalah mahasiswa yang berkolaborasi untuk menciptakan solusi digital sederhana namun berdampak dalam dunia logistik dan distribusi barang.

![team](https://github.com/user-attachments/assets/f384ff4d-54af-4ecf-be96-dea6c03f378a)

---

> Terima kasih telah menggunakan Cargo!
> Semoga aplikasi ini dapat bermanfaat dan memudahkan proses logistik Anda. 🚀

---
