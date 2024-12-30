@extends('layout.layout_user.index', ['page' => __('kontak_kami'), 'pageSlug' => 'kontak_kami'])

@section('content')

<!-- hero section start  -->
<section id="hero" class=" position-relative overflow-hidden">
    <div class="pattern-overlay pattern-right position-absolute">
      <img src="{{asset ('frontend/images/hero-pattern-right.png')}}" alt="pattern">
    </div>
    <div class="pattern-overlay pattern-left position-absolute">
      <img src="{{asset ('frontend/images/hero-pattern-left.png')}}" alt="pattern">
    </div>
    <div class="container text-center py-5 mt-5">
      <div class="row my-5">
        <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
          <h2 class="page-title display-3 mt-5">Kontak Kami</h2>
          <nav class="breadcrumb">
            <a class="breadcrumb-item" href="index.html">Home</a>
            <span class="breadcrumb-item active" aria-current="page">Kontak</span>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us-wrap py-5 mt-5">
    <div class="container">
      <div class="row">
        <div class="contact-info col-md-6">
          <h2 class="fs-3 text-uppercase mb-4">Informasi Kontak</h2>
          
          <div class="page-content">
            <div class="col-md-6">
              <div class="content-box my-5">
                <h5 class="element-title text-uppercase fs-6 fw-bold ">Griya Tenda Adventure</h5>
                <div class="contact-address">
                  <p>8J83+J94 Kepil, Kwasa, Gergunung, Kec. Klaten Utara, Kabupaten Klaten, Jawa Tengah 57433</p>
                </div>
                <div class="contact-number ">
                  <a href="#" style="font-weight:bold; margin-left:-1vh;">08814143084</a>
                </div>
                <div class="email-address">
                  <p>
                    <a href="#" style="color: dodgerblue; margin-left:-1vh;">griyatendaadventure@gmail.com</a>
                  </p>
                </div>
              </div>
            </div>
  
            <div class="col-md-6">
              <div class="content-box my-5">
                <h5 class="element-title text-uppercase fs-6 fw-bold ">Medsos Kami</h5>
                <div class="social-links">
                  <ul class="list-unstyled d-flex gap-3 mt3 ">
                    
                    <li>
                      <a href="https://www.instagram.com/griyatenda_adv?igsh=amcyMzZzbGFxZXA4" class="text-secondary me-3 p-0">
                        <iconify-icon icon="ri:instagram-line" class="social-icon "></iconify-icon>
                      </a>
                    </li>
              
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="inquiry-item col-md-6">
          <h2 class="fs-3 text-uppercase mb-4">Apakah anda ada pertanyaan ?</h2>
          <p>Gunakan form dibawah ini jika anda memiliki pertanyaan untuk kami</p>
          <form id="form" class="form-group flex-wrap" method="POST" action="question">
            @csrf
            <div class="form-input col-lg-12 d-flex mb-3">
              <input type="text" name="nama" id="nama" placeholder="Tulis nama anda" class="form-control ps-3 me-3">
              <input type="text" name="email" id="email" placeholder="Tulis email anda" class="form-control ps-3">
            </div>
            <div class="col-lg-12 mb-3">
              <input type="text" name="nomor_wa" id="nomor_wa" placeholder="Nomor WA" class="form-control ps-3">
            </div>
            <div class="col-lg-12 mb-3">
              <input type="text" name="judul" id="judul" placeholder="Tulis judul dari pesan anda" class="form-control ps-3">
            </div>
            <div class="col-lg-12 mb-3">
              <textarea id="pesan" name="pesan" placeholder="Tulis pesan yang ingin anda sampaikan" class="form-control ps-3" rows="8"></textarea>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg text-uppercase btn-rounded-none">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  @endsection