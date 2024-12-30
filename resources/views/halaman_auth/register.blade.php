<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | Dan Aleko</title>
  <link rel="icon" type="image/png" href="{{ asset('halaman_auth/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('halaman_auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('halaman_auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('halaman_auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('halaman_auth/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('halaman_auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('halaman_auth/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('halaman_auth/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('halaman_auth/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('halaman_auth/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('halaman_auth/css/main.css') }}">
    <!--===============================================================================================-->
  <link rel="stylesheet" href="{{asset('halaman_auth/css/styles.css')}}">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/1798e305d9.js" crossorigin="anonymous"></script>
</head>
<body>
                
    
    <div class="wrapper">
        <form action="{{ route('registrasi') }}" class="validate-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <ul>
                                <li>{{ Session::get('success') }}</li>
                            </ul>
                        </div>
                    @endif

                    <h1>Registration</h1>

                    <div class="input-box">
                        <input type="text" name="email" placeholder="Email" required>
                        <i class="fa-regular fa-envelope"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class='bx bxs-lock-alt' ></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="fullname" placeholder="Nama Lengkap" required>
                        <i class='bx bxs-user'></i>
                    </div>

                    <div>
                        <span class="gender-title">Jenis Kelamin :</span>
                        <span class="gender-detail"></span>
                        <input type="radio" class="gender-detail" name="jenis_kelamin" id="laki-laki" value="Laki-laki"/>
                        <span class="gender-title"></span>Laki-laki
                        <span class="gender-detail"></span>
                        <input type="radio" class="gender-detail" name="jenis_kelamin" id="perempuan" value="Perempuan"/>
                        <span class="gender-title"></span>Perempuan
                        <br />
                    </div>

                    <div class="input-box">
                        <input type="text" name="nomor_wa" placeholder="No.WA" required>
                        <i class="fa-solid fa-mobile-screen"></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="alamat" placeholder="Alamat" required>
                        <i class="fa-solid fa-location-dot"></i>
                    </div>

                    <div style="margin : 20px 20px 40px 20px;">
                        <label for="gambar" style="margin-bottom: 10px; font-size: 16 pt; color: #ffffff;">Gambar</label>
                        <input class="input100" type="file" name="gambar" id="gambar"style="margin-left: -40px;">
                    </div>

                    <button type="submit" class="btn">Register</button>
                    <div class="register-link">
                        <p style="color: #ffffff">Account Allready? <a href="{{ route('auth') }}" style="color: orange">Login</a></p>
                        
                    </div>
        </form>
    </div>





  <!--===============================================================================================-->
  <script src="{{ asset('halaman_auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('halaman_auth/vendor/animsition/js/animsition.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('halaman_auth/vendor/bootstrap/js/popper.js') }}"></script>
  <script src="{{ asset('halaman_auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('halaman_auth/vendor/select2/select2.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('halaman_auth/vendor/daterangepicker/moment.min.js') }}"></script>
  <script src="{{ asset('halaman_auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('halaman_auth/vendor/countdowntime/countdowntime.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('halaman_auth/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>