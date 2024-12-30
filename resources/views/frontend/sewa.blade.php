@extends('layout.layout_user.index', ['page' => __('sewa'), 'pageSlug' => 'sewa'])

@section('content')

<!-- hero section start  -->
<section id="hero" class=" position-relative overflow-hidden">
    <div class="pattern-overlay pattern-right position-absolute">
        <img src="{{asset ('frontend/images/hero-pattern-right.png')}}" alt="pattern">
    </div>
    <div class="pattern-overlay pattern-left position-absolute">
        <img src="{{asset ('frontend/images/hero-pattern-left.png')}}" alt="pattern">
    </div>
    <div class="hero-content container text-center">
        <div class="row">
            <div class="detail mb-4">
                <h1 class="">Cari perlengkapan<span class="text-primary"> adventure anda</span> </h1>
                <p class="hero-paragraph">Kami memiliki banyak koleksi perlengkapan adventure terbaik yang dapat anda sewa.</p>
            </div>
        </div>
    </div>
</section>

<!-- search section start  -->
<section>
    <div class="container search-block p-5">

      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif

      @if (session('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif
        <form class="row justify-content-center" method="GET" action="{{ route('sewa') }}">
            <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0 position-relative text-center">
                <label for="kategori_id" class="label-style text-capitalize form-label justify-content-center">Jenis Perlengkapan</label>
                <select class="form-select form-control p-3" id="kategori_id" name="kategori_id" aria-label="Default select example" style="background-image: none;">
                    <option value="" style="text-align: center">Pilih Jenis Perlengkapan</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }} style="text-align: center">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0 position-relative text-center">
                <label for="search" class="label-style text-capitalize form-label">Nama Perlengkapan</label>
                <input type="text" class="form-control p-3 position-relative" id="search" name="search" value="{{ request('search') }}" style="text-align: center" placeholder="Tulis Nama Perlengkapan" />
                
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Cari Perlengkapanmu</button>
            </div>
        </form>
    </div>
  
    <div class="container" style="padding-top: 130px">
      <div class="row">

        @forelse($barangs as $item) 
      
            <div class="col-md-4 my-4">
              <div class="card" >
                <a href=""><img class="center" style="width: 80%;" src="{{asset('storage/barang/'.$item->gambar)}}"></a>
                <div class="card-body p-4">
                  <a href="">
                    <h4 class="card-title" style="margin-bottom: -5%">{{ $item->nama_barang}}</h4>
                  </a>
                  <div class="card-text" style="margin-bottom: -5%">
                    <ul class="d-flex list-unstyled">
                      <li class="rental-list">
                        {{ $item->kategori->nama_kategori }}
                      </li>
                    </ul>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between">
                    <h3 class="pt-2" style="font-size: 30px">Rp. {{number_format($item->harga_sewa, 0, ',', '.')}}<span class="rental-price">/day</span></h3>
                    
                    <form action="cart" method="POST">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $item->id }}">
                      <!-- Input untuk jumlah produk -->
                      <input type="hidden" name="jumlah" value="1" min="1">
                      <input type="hidden" name="hari" value="1" min="1">
                      <button type="submit" class="btn btn-primary">Sewa</button>
                    </form>
                    
                    
                  </div>
                </div>
              </div>
            </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center">Barang tidak ditemukan.</p>
               </div>
        @endforelse
      </div>
    </div>
  </section>


@endsection