# 🚗 E-Parking System

Aplikasi web untuk membantu pengelolaan operasional parkir, mulai dari pencatatan kendaraan masuk dan keluar hingga pemantauan transaksi dan pembuatan laporan.

Proyek ini dikembangkan menggunakan **Laravel 10** sebagai proyek Uji Kompetensi Keahlian (UKK) Rekayasa Perangkat Lunak.

## 🎯 Tujuan

Membangun sistem pengelolaan parkir berbasis web yang membantu petugas mencatat transaksi secara terstruktur serta memudahkan admin dan owner memantau data operasional.

## 🧰 Teknologi yang Digunakan

- **Backend:** PHP 8.1+ dan Laravel 10
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **Build tools:** Vite dan npm
- **Pembuatan laporan PDF:** Laravel DomPDF
- **QR Code:** SimpleSoftwareIO Simple QR Code

## ✨ Fitur Utama

### 👥 Autentikasi dan Hak Akses

- Login dan logout pengguna.
- Pembagian hak akses berdasarkan peran: **Admin**, **Petugas**, dan **Owner**.
- Dashboard yang disesuaikan dengan peran pengguna.

### 🅿️ Pengelolaan Parkir

- Pencatatan kendaraan masuk dan keluar menggunakan kode struk.
- Pencatatan dan pelacakan transaksi parkir.
- Pengelolaan data pendukung operasional, seperti area, kapasitas, tarif, tipe kendaraan, dan data member.

### 📊 Laporan dan Pemantauan

- Laporan parkir harian.
- Laporan transaksi berdasarkan rentang tanggal.
- Laporan berdasarkan tipe kendaraan.
- Laporan okupansi area parkir.
- Ekspor laporan ke format PDF.

### 🛠️ Administrasi dan Pemeliharaan Data

- Fitur backup dan restore data.
- Pencatatan log aktivitas/perubahan untuk membantu pemantauan aktivitas pengguna.
- Pengelolaan data pengguna sesuai hak akses.

## 🧑‍💻 Cara Menjalankan Project

### Prasyarat

Pastikan perangkat sudah memiliki:

- PHP 8.1 atau lebih baru
- Composer
- MySQL
- Node.js dan npm

### Langkah Instalasi

**1. Clone repository**

\```bash
git clone https://github.com/Aaalyaa/E-parking.system.git
cd E-parking.system
\```

**2. Install dependency PHP**

\```bash
composer install
\```

**3. Siapkan file konfigurasi environment**

\```bash
cp .env.example .env
\```

Pada Windows, file `.env.example` juga dapat disalin secara manual menjadi `.env`.

**4. Buat database MySQL**

Buat database kosong, lalu sesuaikan konfigurasi pada file `.env`:

\```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
\```

Ganti nilai contoh sesuai konfigurasi MySQL lokal.

**5. Generate application key**

\```bash
php artisan key:generate
\```

**6. Jalankan migration dan seeder**

\```bash
php artisan migrate --seed
\```

Periksa file migration dan seeder terlebih dahulu. Seeder digunakan untuk menyiapkan data awal aplikasi, termasuk data yang mungkin dibutuhkan untuk autentikasi.

**7. Install dependency frontend dan build asset**

\```bash
npm install
npm run build
\```

**8. Jalankan aplikasi**

\```bash
php artisan serve
\```

Buka alamat lokal yang ditampilkan oleh Artisan di browser.

## 📁 Struktur Project

Struktur utama mengikuti konvensi Laravel:

- `app/` — model, controller, helper, dan logika aplikasi.
- `database/` — migration, factory, dan seeder.
- `resources/` — view Blade serta aset frontend.
- `routes/` — definisi route aplikasi.
- `public/` — file publik dan hasil build aset.
- `config/` — konfigurasi aplikasi Laravel.

## 📌 Catatan

- Repository ini merupakan proyek pembelajaran/UKK dan dapat memerlukan penyesuaian konfigurasi sesuai lingkungan lokal.
- Belum ada tautan demo online yang dicantumkan; jalankan aplikasi secara lokal mengikuti petunjuk instalasi di atas.

## 👩‍💻 Pengembang

**Aaalyaa**  
GitHub: [@Aaalyaa](https://github.com/Aaalyaa)
