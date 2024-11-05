<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Pengguna</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ url('/') }}" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register untuk akun baru</p>
        <form action="{{ route('register') }}" method="POST" id="form-register">
          @csrf
          <div class="input-group mb-3">
              <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="input-group mb-3">
              <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
          </div>
          <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password (min. 6 karakter)" required>
          </div>
          <div class="input-group mb-3">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
          </div>
          <div class="input-group mb-3">
              <select name="level_id" class="form-control" required>
                  <option value="1">Admin</option>
                  <option value="2">Manager</option>
                  <option value="3">Staff</option>
                  <option value="4">Customer</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Daftar</button>
      </form>
                
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>