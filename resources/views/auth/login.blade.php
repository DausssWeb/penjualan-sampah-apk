<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>

  <link rel="icon" href="{{ asset('template/dist') }}/assets/images/favicon.svg" type="image/x-icon">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- Login Card -->
  <div class="card card-outline card-success">
    <div class="card-header text-center text-success">
      <a href="{{ route('welcome') }}" class="h1"><b>Jasa :</b>Jual Sampah</a>
    </div>
    <div class="card-body">

      {{-- ALERT DANGER KETIKA GAGAL LOGIN --}}
      @if(session('error'))
        <div class="alert text-success border border-success bg-light text-center p-2 mb-3" role="alert" style="font-size: 14px;">
          {{ session('error') }}
        </div>
      @endif

      <p class="login-box-msg">Jual Sampah Yuk!</p>

      <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email --}}
        <div class="input-group mb-3">
          <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off"autofokus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        {{-- Password --}}
        <div class="input-group mb-3">
          <input id="password" type="password" placeholder="Password"
                 class="form-control @error('password') is-invalid @enderror" name="password" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        {{-- Remember Me + Button --}}
        <div class="row">
          <div class="col-8">
            <div class="icheck-success">
              <input class="form-check-input" type="checkbox" name="remember" id="remember"
                     {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <p class="mt-3 mb-1">
        Belum punya akun?<a href="{{ route('register') }}" class="text-primary"> Daftar</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
