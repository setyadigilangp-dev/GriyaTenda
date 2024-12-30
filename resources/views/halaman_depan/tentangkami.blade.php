@extends('halaman_depan.index', ['page' => __('tentang_kami'), 'pageSlug' => 'tentang_kami'])

@section('content')

<!-- hero section start  -->
<section id="hero" class=" position-relative overflow-hidden">
        <div class="pattern-overlay pattern-right position-absolute">
            <img src="{{asset ('frontend/images/hero-pattern-right.png')}}" alt="pattern">
        </div>
        <div class="pattern-overlay pattern-left position-absolute">
            <img src="{{asset ('frontend/images/hero-pattern-left.png')}}" alt="pattern">
        </div>
        <div class=" container text-center py-5 mt-5">
            <div class="row my-5 ">
                <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
                    <h2 class="page-title display-3 mt-5">Tentang Kami</h2>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="index.html">Home</a>
                        <span class="breadcrumb-item active" aria-current="page">Tentang Kami</span>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section id="about-us" class="my-5 py-5">

        <div class="vertical-element">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-5">
                        <div class="image-holder">
                            <img src="{{ asset('frontend/images/gta.jpg')}}" style="width: 90%" alt="about-us" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-element ps-0 p-5">
                            <h2 class="mb-3">Siapa <span class="text-primary"> kita? </span></h2>

                            <p>Kita adalah store yang berfokus pada penyewaan alat alat outdoor yang sudah berdiri sejak 2016, kita mencoba untuk mempermudah para pemula yang minim budget untuk membeli peralatan, 
                                sehingga kita menyediakan solusi nya dengan menyewa peralatan tersebut sehingga tidak memberatkan pemula yang baru memulai aktivitas outdoor,
                                 yang entah itu pendakian atau aktivitas outdoor lain nya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="vertical-element mt-5 py-5">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-md-6">
                        <div class="section-element ps-0 p-5">
                            <h2 class="mb-3">Layanan terbaik <span class="text-primary"> yang bisa kita janjikan ? </span></h2>

                            <p>Kita menyediakan pelayanan terbaik dalam bagian kebersihan alat yang kami sewa kan,
                                sehingga pelanggan yang menyewa juga nyaman ketika menyewa alat ditempat kita, 
                                karena rata rata pelanggan saat menyewa alat tersebut akan langsung dipakai.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="image-holder">
                            <img src="{{ asset('frontend/images/kebersihan.jpg')}}" style="width: 90%" alt="about-us" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @endsection