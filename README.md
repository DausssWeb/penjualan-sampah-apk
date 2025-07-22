<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Aplikasi Penjualan Sampah - Laravel 12

Aplikasi berbasis web untuk menjual sampah daur ulang oleh masyarakat kepada perusahaan.

## Fitur Utama

- Autentikasi pengguna (Login & Register)
- Role-based access (Admin & Masyarakat)
- Dashboard harga sampah
- Form jual sampah
- Riwayat aktivitas jual
- Pengelolaan profil pengguna

## Teknologi

- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap

## Instalasi

1. Clone repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   cp .env.example .env   # Linux/macOS
   # atau
   copy .env.example .env # Windows  
   php artisan key:generate
   php artisan migrate
   php artisan db:seed --class=DatabaseSeeder
   php artisan db:seed --class=RoleSeeder
   php artisan storage:link
   npm run serve-all
