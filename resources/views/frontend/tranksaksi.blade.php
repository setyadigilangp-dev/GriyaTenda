@extends('layout.layout_user.index', ['page' => __('tranksaksi'), 'pageSlug' => 'tranksaksi'])

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

<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5" style="border: 2px solid #828181; box-shadow: 10px 10px 15px #a1a1a1;); border-radius: 9px;">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="contact-us-wrap py-5">
    <div class="container">
      <div class="row ">
        <div class="inquiry-item offset-md-2 col-md-8">
          <h2 class=" text-center my-5">Sewa <span class="text-primary">Perlengkapanmu</span> </h2>

          
          <form id="form" class="form-group flex-wrap">
            <p style="margin-bottom: 2px">Nama Barang</p>
            <div class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" style="color:black;background-color:#9fb99c;">
              {{ $data->nama_barang }}
            </div> 
            <p style="margin-bottom: 2px">Stok Barang</p>
            <div class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" style="color:black;background-color:#9fb99c;">
              {{ $data->stok }}
            </div> 
            <p style="margin-bottom: 2px">Harga Sewa</p>
            <div class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" style="color:black;background-color:#9fb99c;">
              Rp. {{number_format($data->harga_sewa)}}
            </div>
            <p style="margin-bottom: 2px">Denda Rusak</p>
            <div class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" style="color:black;background-color:#9fb99c;">
              Rp. {{number_format($data->denda_rusak)}}
            </div>
            <p style="margin-bottom: 2px">Denda Hilang</p>
            <div class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" style="color:black;background-color:#9fb99c;">
              Rp. {{number_format($data->denda_hilang)}}
            </div>
            <p style="margin-bottom: 2px">Nama Penyewa</p>
            <div class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" style="color:black;background-color:#9fb99c;">
              {{ Auth::user()->fullname }}
            </div> 

            <div class="form-input col-lg-12 mb-3">
              <label for="return-date" class="label-style fw-medium form-label"> Pick-up
                Date and Time</label>
              <div class="form-input col-lg-12 d-flex mb-3">
                <div class="input-group date" id="datepicker">
                  <input type="date" id="start" name="appointment" min="2023-01-01" max="2023-12-31"
                    class="form-control p-3 me-3">
                </div>
                <div class="input-group time" id="timepicker">
                  <input type="time" id="start" name="appointment" min="9AM" max="6PM" class="form-control p-3">
                </div>
              </div>
            </div>

            <div class="form-input col-lg-12 mb-3">
              <label for="return-date" class="label-style fw-medium form-label">Returning
                Date and Time</label>
              <div class="form-input col-lg-12 d-flex mb-3">
                <div class="input-group date" id="datepicker">
                  <input type="date" id="start" name="appointment" min="2023-01-01" max="2023-12-31"
                    class="form-control p-3 me-3">
                </div>
                <div class="input-group time" id="timepicker">
                  <input type="time" id="start" name="appointment" min="9AM" max="6PM" class="form-control p-3">
                </div>
              </div>

            </div>

            <div class="form-input col-lg-12 d-flex mb-3">
              <input type="text" name="email" placeholder="Write Your Name Here" class="form-control p-3 me-3">
              <input type="text" name="email" placeholder="Write Your Email Here" class="form-control p-3">
            </div>
            <div class="col-lg-12 mb-3">
              <input type="text" name="email" placeholder="Phone Number" class="form-control p-3">
            </div>
            <div class="col-lg-12 mb-3">
              <textarea placeholder="Write Your Message Here" class="form-control p-3" rows="8"></textarea>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
        </div>
    </div>
</section>








@endsection