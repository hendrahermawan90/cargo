# 🚚 Cargo – Aplikasi Web Manajemen Pengiriman Barang

**Cargo** adalah aplikasi web berbasis Laravel yang dikembangkan oleh **Kelompok 5** untuk membantu perusahaan logistik maupun pengguna individu dalam mengelola proses pengiriman barang secara efisien dan modern.

Aplikasi ini hadir dengan fitur pelacakan real-time, manajemen pengguna berbasis peran, otentikasi Google, pencetakan resi otomatis, serta dashboard statistik yang informatif.

---

## ✨ Fitur Unggulan

- 📦 **Manajemen Pengiriman**  
  Buat, ubah, dan kelola data pengiriman barang secara dinamis, lengkap dengan status pengiriman: *dalam proses*, *terkirim*, *gagal*, dll.

- 🗺️ **Pelacakan Pengiriman (Tracking)**  
  Lacak status dan lokasi pengiriman menggunakan kode resi unik.

- 👥 **Manajemen Pengguna & Pelanggan**  
  Akses berbasis peran (*admin*, *kurir*, dan *pelanggan*) dengan otorisasi terpisah sesuai kebutuhan.

- 🔐 **Login dengan Google**  
  Otentikasi cepat dan aman melalui Google menggunakan Laravel Socialite.

- 📊 **Dashboard Admin Interaktif**  
  Menyajikan data statistik seperti jumlah pengiriman, status paket, dan aktivitas pengguna.

- 🧾 **Cetak Resi & Laporan PDF**  
  Otomatisasi pencetakan resi dan laporan pengiriman dalam format PDF berdasarkan filter tanggal.

- 📱 **Desain Responsif & Mobile-Friendly**  
  Tampilan antarmuka yang optimal di berbagai perangkat, mulai dari desktop hingga ponsel.

---

## 🔒 Integrasi Google Login

Untuk mengaktifkan Google Login:

1. Daftarkan aplikasi Anda di [Google Cloud Console](https://console.cloud.google.com/).
2. Aktifkan OAuth 2.0.
3. Masukkan `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, dan `GOOGLE_REDIRECT_URI` pada file `.env`.

---

## 👨‍💻 Dibuat oleh – Kelompok 5

> Kami adalah mahasiswa yang berkolaborasi untuk menciptakan solusi digital sederhana namun berdampak dalam dunia logistik.

![team](https://github.com/user-attachments/assets/f384ff4d-54af-4ecf-be96-dea6c03f378a)

---

> Terima kasih telah menggunakan Cargo!  
> Semoga aplikasi ini bisa bermanfaat dan memudahkan proses logistik Anda. 🚀
