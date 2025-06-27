<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <link rel="icon" href="{{ asset('template/dist') }}/assets/images/favicon.svg" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-success">
    <div class="card-header text-center text-success">
      <a href="{{ route('welcome') }}" class="h1"><b>Jasa :</b>Jual Sampah</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Daftar untuk bergabung</p>

      <form action="{{ route('register') }}" method="post">
        @csrf

        <!-- Name -->
        <div class="mb-3">
          <div class="input-group">
            <input id="name" type="text" placeholder="Nama Lengkap" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
          </div>
          @error('name')
            <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <!-- role -->
        <div class="mb-3">
          <div class="input-group">
                <select name="role_id" id="role_id" class="form-control" @error('role_id') is-invalid @enderror" value="{{ old('role_id') }}" required>
                    <option value="">Pilih Role</option>
                    <option value="2">Masyarakat</option>
                </select>
                <div class="input-group-append">
                  <div class="input-group-text"><span class="fas fa-users"></span></div>
                </div>
            </div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <div class="input-group">
            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
          </div>
          @error('email')
            <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
          <div class="input-group">
            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>
          @error('password')
            <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <!-- Password Confirmation -->
        <div class="mb-3">
          <div class="input-group">
            <input id="password-confirm" type="password" placeholder="Konfirmasi Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="row">
          <div class="col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Daftar</button>
          </div>
        </div>
      </form>

      <p class="mt-3 mb-1">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-center">Masuk</a>
      </p>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
