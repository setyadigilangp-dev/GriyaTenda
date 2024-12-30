<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoCar - Free Bootstrap Website Template for Car Rental</title>

    <!--vendor css ================================================== -->
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor.css')}}">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!--Bootstrap ================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    

    <!-- Style Sheet ================================================== -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@700&family=Raleway:wght@400;700&display=swap"
        rel="stylesheet">
    


    <!-- script ================================================== -->
    <script src="{{ asset('frontend/js/modernizr.js')}}"></script>

</head>

    <!-- navbar  -->
    @include('layout.layout_user.navbar')
    <!-- end-navbar  -->

    <!-- content  -->
    <section class="section">
                       
    
        <div class="section-body">
            @yield('content')
        </div>
    </section>
    <!-- end-content  -->

    <!-- Footer -->
    @include('layout.layout_user.footer')
    <!-- End-Footer -->
    




    <!-- script ================================================== -->
    <script src="{{ asset('frontend/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{ asset('frontend/js/plugins.js')}}"></script>
    <script src="{{ asset('frontend/js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>

</body>

</html>