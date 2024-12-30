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

                    <h1>Lupa Password</h1>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-box">
                            <input type="text" name="email" placeholder="Email" required>
                            <i class="fa-regular fa-envelope"></i>
                        </div>

                        <button type="submit" class="btn">Kirim Tautan Reset</button>
                    </form>
                    @if(session('status'))
                        <p>{{ session('status') }}</p>
                    @endif

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