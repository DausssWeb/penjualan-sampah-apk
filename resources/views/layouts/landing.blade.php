<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penjualan Sampah Digital</title>
  
  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('images/admin.jpg') }}" type="image/x-icon"> 
  <!-- [Google Font] Family -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/tabler-icons.min.css" >
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/feather.css" >
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/fontawesome.css" >
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/material.css" >

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
      font-family: 'Segoe UI', sans-serif;
    }

    .content {
      flex: 1 0 auto;
    }

    footer {
      flex-shrink: 0;
      background-color: #28a745;
      color: white;
      padding: 20px 0;
      text-align: center;
    }

    .hero {
      background: linear-gradient(to right, #28a745, #62c275);
      color: white;
      padding: 100px 0;
      text-align: center;
    }

    .fitur {
      padding: 60px 0;
    }

    .fitur .icon {
      font-size: 48px;
      color: #28a745;
    }

    .section-lain {
      padding: 60px 0;
    }

    .section-lain img {
      width: 100%;
      border-radius: 10px;
    }
    .img-medium {
     max-width: 80%;
     height: auto;
     margin: 0 auto;
     display: block;
    }

  </style>
</head>
<body>

<div class="content">
  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1 class="display-5 fw-bold">Jasa Jual Sampah Mudah dan Cepat</h1>
      <p class="lead">Bersama kami, ubah sampah menjadi penghasilan. Praktis, aman, dan ramah lingkungan.</p>
      <a href="{{ route('login') }}" class="btn btn-light me-2">Login</a>
      <a href="{{ route('register') }}" class="btn btn-outline-light">Daftar</a>
    </div>
  </section>

  <!-- Fitur Unggulan -->
  <section class="fitur bg-light text-center">
    <div class="container">
      <h2 class="mb-5">Fitur Unggulan</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="icon mb-3"><i class="fas fa-recycle"></i></div>
          <h5>Penjualan Mudah</h5>
          <p>Jual sampah anorganik atau daur ulang langsung dari rumah hanya dengan beberapa klik.</p>
        </div>
        <div class="col-md-4">
          <div class="icon mb-3"><i class="fas fa-bell"></i></div>
          <h5>Notifikasi Harga</h5>
          <p>Dapatkan update harga sampah terkini dari mitra pembeli atau pengepul resmi.</p>
        </div>
        <div class="col-md-4">
          <div class="icon mb-3"><i class="fa-solid fa-money-bill-wave"></i></div>
          <h5>Pembayaran Cepat</h5>
          <p>Dibayar langsung di tempat saat penjemputan, tanpa perlu proses yang rumit. praktis dan instan!</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Konten Tambahan -->
  <section class="section-lain">
    <div class="container">
      <div class="row align-items-center mb-5">
        <div class="col-md-6">
          <img src="{{ asset('images/petugas-sampah.jpg') }}" alt="Pengumpulan Sampah" class="img-medium" data-aos="fade-right" data-aos-delay="800" data-aos-duration="1000">
        </div>
        <div class="col-md-6">
          <h3>Apa Itu Penjualan Sampah Digital?</h3>
          <p>
            Sistem ini memungkinkan masyarakat menjual sampah yang dapat didaur ulang secara langsung kepada pengepul atau mitra, tanpa harus keluar rumah. Cukup upload data sampah dan tunggu kurir datang menjemput.
          </p>
        </div>
      </div>

      <div class="row align-items-center">
        <div class="col-md-6 order-md-2">
          <img src="{{ asset('images/anakmuda-mobile.jpg') }}" alt="Eco-friendly" class="img-medium" data-aos="fade-left" data-aos-delay="800" data-aos-duration="1000">
        </div>
        <div class="col-md-6 order-md-1">
          <h3>Kontribusi untuk Lingkungan</h3>
          <p>
            Dengan mendigitalisasi penjualan sampah, kita turut menjaga lingkungan tetap bersih, mengurangi pencemaran, dan mendukung ekonomi sirkular. Setiap tindakan kecil memberi dampak besar.
          </p>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Footer -->
<footer>
  &copy; {{ date('Y') }} Aplikasi Penjualan Sampah Digital – Go Green, Go Digital!
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>
