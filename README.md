# 📦 Manajemen Barang & Mutasi Frontend

Selamat datang di proyek Manajemen Barang & Mutasi! 🚀 Proyek ini merupakan frontend untuk aplikasi manajemen barang dan mutasi yang dibangun menggunakan Laravel. Dengan desain yang sederhana namun fungsional, Anda dapat mengelola barang dan mencatat mutasi dengan mudah dan efisien.

## 🎯 Fitur Utama
- 🔐 Autentikasi: Login dan register menggunakan Laravel Breeze.
- 📦 Manajemen Barang: CRUD (Create, Read, Update, Delete) untuk barang.
- 🔄 Manajemen Mutasi: Kelola mutasi barang dengan mudah, mencakup penambahan, penghapusan, dan peninjauan riwayat mutasi.
- 🔍 Pencarian Dinamis: Temukan barang dan mutasi dengan cepat menggunakan fitur pencarian.
- 📊 Tampilan Responsif: Didukung oleh Bootstrap, memastikan tampilan optimal di berbagai perangkat.

## 🚀 Instalasi

1. Clone Repository:
```bash
git clone https://github.com/username/repo-manajemen-barang.git
cd repo-manajemen-barang

```

2. Instal Dependencies:
```bash
composer install
npm install
npm run dev
```

3. Konfigurasi Enviromnment:
```bash
cp .env.example .env
php artisan key:generate
```
4. Jalankan Aplikasi:
```bash
php artisan serve
```

## 📂 Struktur Proyek
- resources/views: Tempat file Blade template untuk tampilan frontend.
- public/css: Gaya kustom untuk proyek ini.
- public/js: Skrip JavaScript yang digunakan dalam proyek.
- routes/web.php: Definisi rute untuk aplikasi frontend.

