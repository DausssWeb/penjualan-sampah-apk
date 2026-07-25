<div align="center">

<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">

# ♻️ Aplikasi Penjualan Sampah

![Laravel](https://img.shields.io/badge/Laravel_12-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP_8.2+-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)

[![Build Status](https://github.com/laravel/framework/workflows/tests/badge.svg)](https://github.com/laravel/framework/actions)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/framework)

**Platform digital untuk menjual sampah daur ulang dari masyarakat ke perusahaan pengolah sampah.**

</div>

---

## 🌟 Tentang Aplikasi

Aplikasi Penjualan Sampah adalah solusi berbasis web yang menghubungkan **masyarakat** dengan **perusahaan daur ulang** secara efisien dan transparan. Masyarakat dapat menjual sampah daur ulang mereka dengan mudah melalui platform ini, sementara admin dapat mengelola seluruh transaksi dan harga sampah secara terpusat.

---

## ✨ Fitur Utama

| Fitur | Keterangan |
|-------|------------|
| 🔐 Autentikasi | Login & Register pengguna |
| 👥 Role-based Access | Hak akses Admin & Masyarakat |
| 💰 Dashboard Harga | Informasi harga sampah terkini |
| 📦 Form Jual Sampah | Pengajuan penjualan sampah mudah & cepat |
| 📋 Riwayat Aktivitas | Histori transaksi penjualan |
| 👤 Profil Pengguna | Pengelolaan data diri pengguna |

---

## 🛠️ Teknologi yang Digunakan

- **Framework** — Laravel 12
- **Language** — PHP 8.2+
- **Database** — MySQL
- **Frontend** — Bootstrap

---

## 🚀 Cara Instalasi

### Prasyarat
Pastikan sudah terinstall:
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/DausssWeb/penjualan-sampah-apk.git
cd penjualan-sampah-apk
```

**2. Install dependencies**
```bash
composer install
npm install
```

**3. Setup environment**
```bash
# Linux/macOS
cp .env.example .env

# Windows
copy .env.example .env
```

**4. Generate app key**
```bash
php artisan key:generate
```

**5. Konfigurasi database**

Edit file `.env` sesuaikan dengan database kamu:
```env
DB_DATABASE=penjualan_sampah
DB_USERNAME=root
DB_PASSWORD=
```

**6. Migrasi & Seeder**
```bash
php artisan migrate
php artisan db:seed --class=DatabaseSeeder
php artisan db:seed --class=RoleSeeder
```

**7. Storage link**
```bash
php artisan storage:link
```

**8. Jalankan aplikasi**
```bash
npm run serve-all
```

---

## 👤 Author

<div align="center">

**Faisal Rahmat Firdaus**

[![GitHub](https://img.shields.io/badge/GitHub-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.com/DausssWeb)
[![Instagram](https://img.shields.io/badge/Instagram-%23E4405F.svg?style=for-the-badge&logo=Instagram&logoColor=white)](https://instagram.com/rhmtfrdus._)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-%230077B5.svg?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/faisal-rahmat-firdaus-453959207)

</div>

---

<div align="center">
  
⭐ Jangan lupa kasih star kalau project ini bermanfaat!

</div>
