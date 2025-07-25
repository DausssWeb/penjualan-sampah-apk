
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Penjualan Sampah Digital</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/style.css" id="main-style-link" >
  <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/style-preset.css" >
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
  @vite(['resources/js/app.js'])


  <style>
    .navbar-green {
      background-color: #4ade80 !important; /* green-400 */
      color: white;
    }

    .navbar-green .pc-head-link,
    .navbar-green .ti,
    .navbar-green span,
    .navbar-green i {
      color: white !important;
    }

    .sidebar-green {
      background-color: #4ade80 !important; /* green-400 */
      color: white;
    }

    .sidebar-green .pc-link,
    .sidebar-green .pc-micon,
    .sidebar-green .pc-mtext {
      color: white !important;
    }

    .sidebar-green .pc-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 5px;
    }

    /* Custom styles for the sidebar logo */
    .sidebar-brand-horizontal {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      gap: 10px;
    }

    .sidebar-logo {
      width: 45px;
      height: 45px;
      object-fit: contain;
      border-radius: 8px;
    }

    .sidebar-title {
      font-size: 16px;
      font-weight: bold;
      color: #1f4037;
      margin: 0;
      margin-left: 10px; 
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      text-decoration: none;
    }
  </style>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
<div class="loader-bg ">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar navbar-green pc-sidebar-collapse">
<div class="navbar-wrapper">
  <div class="m-header">
    <a href="{{ route('home') }}" class="b-brand text-primary">
      @if (Auth::user()->role_id == '1')
      <img src="{{ asset('images/admin.jpg') }}" alt="Foto_logo" class="sidebar-logo">
      @else
      <img src="{{ asset('images/logo.jpg') }}" alt="Foto_logo" class="sidebar-logo">
      @endif
      <span>
        @if (Auth::user()->role_id == '1')
          Admin Jual Sampah
        @else
          Jasa Jual Sampah
        @endif
      </span>
    </a>
  </div>
    <hr class="mt-0 border-width-1 border-width-1">
    <div class="navbar-content">
      <ul class="pc-navbar">
        {{-- Admin sidebar --}}
        @if(Auth::user()->role_id == '1')
        <li class="pc-item">
          <a href="{{ route('home') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('users.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-user"></i></span>
            <span class="pc-mtext">Data Pengguna</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('transaksi.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-device-analytics"></i></span>
            <span class="pc-mtext">Data Transaksi</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('harga.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-report-money"></i></span>
            <span class="pc-mtext">Harga Sampah</span>
          </a>
        </li>
        @else
        <li class="pc-item">
          <a href="{{ route('home') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('transaksi.create') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-building-store"></i></span>
            <span class="pc-mtext">Jual Sampah</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('transaksi.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-activity"></i></span>
            <span class="pc-mtext">Aktivitas</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('profile.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-user"></i></span>
            <span class="pc-mtext">Profil</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
</div>
</nav>
<!-- [ Sidebar Menu ] end -->
  
<!-- [ Header Topbar ] start -->
<header class="pc-header sidebar-green shadow-sm">
  <div class="header-wrapper "> 
<!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp ">
  <ul class="list-unstyled">
    <!-- ======= Menu collapse Icon ===== -->
    <li class="pc-h-item pc-sidebar-collapse">
      <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup">
      <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>

    {{-- Tombol Search --}}
    {{-- <li class="dropdown pc-h-item d-inline-flex d-md-none">
      <a
        class="pc-head-link dropdown-toggle arrow-none m-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <i class="ti ti-search"></i>
      </a>
      <div class="dropdown-menu pc-h-dropdown drp-search">
        <form class="px-3">
          <div class="form-group mb-0 d-flex align-items-center">
            <i data-feather="search"></i>
            <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
          </div>
        </form>
      </div>
    </li>
    <li class="pc-h-item d-none d-md-inline-flex">
      <form class="header-search">
        <i data-feather="search" class="icon-search"></i>
        <input type="search" class="form-control" placeholder="Search here. . .">
      </form>
    </li> --}}
  </ul>
</div>
<!-- [Mobile Media Block end] -->
{{-- <div class="ms-auto ">
  <ul class="list-unstyled">
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <i class="ti ti-mail"></i>
      </a>
      <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
          <h5 class="m-0">Message</h5>
          <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
        </div>
        <div class="dropdown-divider"></div>
        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
          <div class="list-group list-group-flush w-100">
            <a class="list-group-item list-group-item-action">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <img src="{{ asset('template/dist') }}/assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
                </div>
                <div class="flex-grow-1 ms-1">
                  <span class="float-end text-muted">3:00 AM</span>
                  <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.</p>
                  <span class="text-muted">2 min ago</span>
                </div>
              </div>
            </a>
            <a class="list-group-item list-group-item-action">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <img src="{{ asset('template/dist') }}/assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar">
                </div>
                <div class="flex-grow-1 ms-1">
                  <span class="float-end text-muted">6:00 PM</span>
                  <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p>
                  <span class="text-muted">5 August</span>
                </div>
              </div>
            </a>
            <a class="list-group-item list-group-item-action">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <img src="{{ asset('template/dist') }}/assets/images/user/avatar-3.jpg" alt="user-image" class="user-avtar">
                </div>
                <div class="flex-grow-1 ms-1">
                  <span class="float-end text-muted">2:45 PM</span>
                  <p class="text-body mb-1"><b>There was a failure to your setup.</b></p>
                  <span class="text-muted">7 hours ago</span>
                </div>
              </div>
            </a>
            <a class="list-group-item list-group-item-action">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <img src="{{ asset('template/dist') }}/assets/images/user/avatar-4.jpg" alt="user-image" class="user-avtar">
                </div>
                <div class="flex-grow-1 ms-1">
                  <span class="float-end text-muted">9:10 PM</span>
                  <p class="text-body mb-1"><b>Cristina Danny </b> invited to join <b> Meeting.</b></p>
                  <span class="text-muted">Daily scrum meeting time</span>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="text-center py-2">
          <a href="#!" class="link-primary">View all</a>
        </div>
      </div>
    </li>
    {{-- Profile --}}
    <li class="dropdown pc-h-item header-user-profile">
      <a class="pc-head-link dropdown-toggle arrow-none me-0"data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"data-bs-auto-close="outside"aria-expanded="false">
        <img src="{{ asset('template/dist') }}/assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
        <span>{{ auth()->user()->name }}</span>
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header">
          <div class="d-flex mb-1">
            <div class="flex-shrink-0">
              <img src="{{ asset('template/dist') }}/assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35">
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="mb-1">{{ auth()->user()->name }}</h6>
              <span>{{ auth()->user()->role?->role_name }}</span>
            </div>
          </div>
        </div>
        <div class="tab-content" id="mysrpTabContent">
          @if (Auth::user()->role_id == '1')
            <a href="{{ route('profile.index') }}" class="dropdown-item">
              <i class="ti ti-user"></i>
              <span>View Profile</span>
            </a>
          @endif
          <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="ti ti-power"></i><span>Logout</span>
                </button>
            </form>
          </div>   
        </div>
        {{-- <div class="tab-content" id="mysrpTabContent">
          <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
            <a href="#!" class="dropdown-item">
              <i class="ti ti-edit-circle"></i>
              <span>Edit Profile</span>
            </a>
            <a href="#!" class="dropdown-item">
              <i class="ti ti-user"></i>
              <span>View Profile</span>
            </a>
            <a href="#!" class="dropdown-item">
              <i class="ti ti-power"></i>
              <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">
                  <span>Logout</span>
                </button>
              </form>
            </a>
          </div>
        </div> --}}
      </div>
    </li>
  </ul>
</div>
 </div>
</header>
<!-- [ Header ] end --></nav> 




  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      {{-- <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Home</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Home</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end --> --}}
       <!-- [ Typography ] start -->
        <div class="col-sm-12">
          <div class="card">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
      <div class="row">
        <div class="col-sm my-1">
          <p class="m-0">  &copy; {{ date('Y') }} Aplikasi Penjualan Sampah Digital </p>
        </div>
        <div class="col-auto my-1">
          <ul class="list-inline footer-link mb-0">
            <li class="list-inline-item">Go Green, Go Digital!</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @stack('js')
  <!-- [Page Specific JS] start -->
  <script src="{{ asset('template/dist') }}/assets/js/plugins/apexcharts.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/plugins/popper.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/plugins/simplebar.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/plugins/bootstrap.min.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/fonts/custom-font.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/pcoded.js"></script>
  <script src="{{ asset('template/dist') }}/assets/js/plugins/feather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

  <script>
        $(document).ready(function() {
            let table = new DataTable('#table');

        $("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });

        });
  </script>
  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  
  @include('sweetalert::alert')
</body>
<!-- [Body] end -->

</html>