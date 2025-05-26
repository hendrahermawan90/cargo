# 🚚 Cargo – Aplikasi Web Manajemen Pengiriman Barang

**Cargo** adalah aplikasi web berbasis Laravel yang dirancang untuk membantu perusahaan logistik dan pengguna individu dalam mengelola proses pengiriman barang dengan efisien. Aplikasi ini dilengkapi dengan fitur-fitur utama seperti pelacakan pengiriman, otentikasi sosial (Google Login), manajemen pelanggan, pencetakan resi, dan dashboard statistik.

## ✨ Fitur Utama

* 📦 **Manajemen Pengiriman**
  Buat, perbarui, dan kelola data pengiriman barang. Termasuk status pengiriman (dalam proses, terkirim, gagal, dll).

* 🗺️ **Pelacakan Pengiriman (Tracking)**
  Lacak status dan posisi pengiriman berdasarkan kode resi unik.

* 👥 **Manajemen Pengguna & Pelanggan**
  Role-based access: admin, kurir, dan pelanggan. Setiap pengguna memiliki akses terbatas sesuai peran.

* 🔐 **Login dengan Google**
  Otentikasi cepat dan aman menggunakan Laravel Socialite.

* 📊 **Dashboard Admin**
  Statistik jumlah pengiriman, kurir aktif, status pengiriman, grafik bulanan, dll.

* 🧾 **Cetak Resi & Laporan**
  Unduh resi pengiriman dalam format PDF dan cetak laporan berdasarkan rentang waktu.

* 📱 **Responsif & Mobile-Friendly**
  Tampilan dioptimalkan untuk desktop maupun perangkat mobile.

---

## 🛠️ Teknologi yang Digunakan

| Kategori      | Teknologi                                           |
| ------------- | --------------------------------------------------- |
| Framework     | Laravel 10+                                         |
| Otentikasi    | Laravel Socialite, Laravel Breeze / Fortify         |
| Database      | MySQL / PostgreSQL                                  |
| Frontend      | Blade, Tailwind CSS (bisa Vue/React jika digunakan) |
| PDF Generator | DomPDF / SnappyPDF                                  |
| Deployment    | Laravel Forge, Docker, atau VPS                     |

---

## ⚙️ Instalasi Lokal

### 1. Clone Repositori

```bash
git clone https://github.com/namakamu/cargo.git
cd cargo
```

### 2. Instal Dependensi

```bash
composer install
npm install && npm run dev
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan dengan konfigurasi database serta kredensial Google OAuth:

```
APP_NAME=Cargo
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_DATABASE=cargo
DB_USERNAME=root
DB_PASSWORD=

GOOGLE_CLIENT_ID=xxx
GOOGLE_CLIENT_SECRET=xxx
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 4. Generate Key & Migrasi Database

```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`.

---

## 🔒 Login dengan Google

Untuk menggunakan fitur login Google, daftarkan aplikasi di [Google Cloud Console](https://console.cloud.google.com/), aktifkan OAuth, dan masukkan kredensial pada `.env`.

---


## 🧪 Pengujian

```bash
php artisan test
```

Untuk pengujian otomatis, kamu bisa menambahkan Laravel Dusk (end-to-end testing).

---

## 🚀 Deployment

Rekomendasi deployment:

* Laravel Forge
* Ploi.io
* Docker + VPS
* Shared Hosting dengan PHP 8.1+

---

## 🤝 Kontribusi



---

## 📄 Lisensi

Aplikasi ini menggunakan lisensi [MIT](LICENSE).

---
