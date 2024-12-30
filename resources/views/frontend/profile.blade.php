@extends('layout.layout_user.index', ['page' => __('profile'), 'pageSlug' => 'profile'])

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
          <h2 class="page-title display-3 mt-5">Profile</h2>
          <nav class="breadcrumb">
            <a class="breadcrumb-item" href="index.html">Home</a>
            <span class="breadcrumb-item active" aria-current="page">Profile</span>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us-wrap py-5 mt-5">

    <div class="container">
        <div class="inquiry-item col-md-6">
            <h2 class="fs-3 text-uppercase mb-4">Edit Profile</h2>
            <form id="form" class="form-group flex-wrap" method="POST" action="{{ route('updateProfile', ['id' => $user->id]) }}" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="id" value="{{ $user->id }}">
            
            <div class="col-lg-12 mb-3">
                <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Nama Lengkap</label>
                <input type="text" name="fullname" id="fullname" class="form-control ps-3" value="{{ $user->fullname }}"required>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Nomor WA</label>
                <input type="text" name="nomor_wa" id="nomor_wa" class="form-control ps-3" value="{{ $user->nomor_wa }}"required>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control ps-3" value="{{ $user->alamat }}"required>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Gambar</label>
                <input type="file" class="form-control-file border" name="gambar" id="gambar" value="{{ $user->gambar }}">
                <br>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none">Submit</button>
            </div>
            </form>
        </div>
    </div>

  </section>

  

  @endsection