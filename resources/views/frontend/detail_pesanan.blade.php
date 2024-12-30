@extends('layout.layout_user.index', ['page' => __('detail_pesanan'), 'pageSlug' => 'detail_pesanan'])

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
                <h2 class="page-title display-3 mt-5">detail pesanan</h2>
                <nav class="breadcrumb">
                  <a class="breadcrumb-item" href="{{ route('dashboard')  }}">Home</a>
                  <span class="breadcrumb-item active" aria-current="page">Detail Pesanan</span>
                </nav>
              </div>
            </div>
          </div>
      </section>


        <section class="card-cart" style="margin-top: 100px; margin-bottom: 100px;">
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
          @if(session('log'))
              <div class="alert alert-info">
                  {{ session('log') }}
              </div>
          @endif
          <div class="row">
              <div class="col-md-8 cart-cart" style="overflow: auto; height: 750px;">
                  <div class="title-cart">
                      <div class="row">
                          <div class="col" style="margin-bottom: -38px;"><h5><b>Detail Item Pesanan</b></h5></div>
                      </div>
                  </div>
                  <hr style="color:black;">
                  <table class="table">
                      <thead class="thead">
                          <tr style="text-align: center; border:">
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                          </tr>
                        </thead>
                  
                  
                      <tbody style="justify-content: center; vertical-align:middle; border:none;">
                          
                        @foreach($rentalItems as $item)
                          
                        
                      
                              <tr style="text-align: center; background-color:white;">
                                  <td><img class="" style="width: 100px;" src="{{asset('storage/barang/'.$item->gambar)}}"></td>
                                  <td>{{ $item->nama_barang}}</td>
                                  <td>
                                      <a href="#" class="border-cart">{{ $item->jumlah}}</a>
                                  </td>
                                  <td><h3 class="pt-2" style="font-size: 15px">Rp. {{ number_format(($item->harga_sewa)*($item->jumlah), 0, ',', '.') }}</h3></td>
                              </tr>
                              
                          @endforeach

                    
                      </tbody>
                  </table>


                  
              </div>
              
                  <div class="col-md-4 summary-cart" style="height: 80vh;">
                     
                      <div style="padding-bottom: 7px;"><h5><b>Detail Pesanan</b></h5></div>
                      <hr style="color:black">
                      
                      

                      <div class="col-lg-12 my-4">
                          <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Tanggal Mengambil Barang</label>
                          <div>
                                <a class="h6">{{ $rental->start_date }}</a>
                          </div>
                      </div>

                      <div class="col-lg-12 my-4">
                          <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Tanggal Mengembalikan Barang</label>
                          <div>
                            <a class="h6">{{ $rental->end_date }}</a>
                        </div>
                      </div>
                      

                      <div class="col-lg-12 my-4">
                          <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Metode Pembayaran</label>
                          <div>
                            <span class="h6">Metode Bayar : </span><span class="h5" >{{ $rental->metopem->metode_bayar }}</span>
                          </div>
                          <div>
                            <span class="h6" >No-Rekening : {{ $rental->metopem->no_rekening }}</span>
                          </div>
                          <div>
                            <span class="h6" >Atas Nama   : {{ $rental->metopem->atas_nama }}</span>
                          </div>
                      </div>

                      <div>
                          @if ($rental->bukti_pembayaran)
                            <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Bukti Pembayaran</label>
                            <!-- Link untuk membuka gambar -->
                            <a href="javascript:void(0);" onclick="showImagePopup('{{ asset('storage/bukti_pembayaran/' . $rental->bukti_pembayaran) }}')" style="color: royalblue">
                            Lihat Bukti Pembayaran
                            </a>
                          @else
                              @if ($canUpload)
                                  <form action="{{ route('rental.uploadBukti', $rental->id) }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <input type="file" name="bukti_pembayaran" required>
                                      <div>
                                        <button type="submit" style="margin-top: 1vh; background-color: #008CBA; border-radius: 5px; border: 1px solid #008CBA; color:white; width:11vh;">Upload</button>
                                      </div>
                                  </form>
                              @else
                                  <span class="text-danger">Pesanan sudah dibatalkan.</span>
                              @endif
                          @endif
                      </div>
                    

                    <!-- Popup container -->
                    <div id="imagePopup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); justify-content: center; align-items: center; z-index: 1000;">
                      <span onclick="closeImagePopup()" style="position: absolute; top: 10px; right: 20px; color: white; font-size: 24px; cursor: pointer;">&times;</span>
                      <button onclick="window.history.back()" style="position: absolute; bottom: 20px; left: 20px; background: rgb(255, 253, 253); color: rgb(0, 0, 0); border: none; padding: 10px 20px; cursor: pointer;">Kembali</button>
                      <img id="popupImage" src="" alt="Bukti Pembayaran" style="max-width: 90%; max-height: 90%;">
                    </div>
                      
                      <hr style="color: black">
                      
                      
                      <div>
                          <h3 class="pt-2" style="font-size: 20px" id="total-price">TOTAL : Rp. {{ number_format(($rental->total), 0, ',', '.') }}</h3>
                          
                      </div>
                      

                  </div>
              

        </section>

        <script>
          function showImagePopup(imageUrl) {
              // Set the image URL to the popup
              const popupImage = document.getElementById('popupImage');
              popupImage.src = imageUrl;
      
              // Show the popup
              const imagePopup = document.getElementById('imagePopup');
              imagePopup.style.display = 'flex';
          }
      
          function closeImagePopup() {
              // Hide the popup
              const imagePopup = document.getElementById('imagePopup');
              imagePopup.style.display = 'none';
          }
      </script>
      <style>
        #imagePopup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
    
        #imagePopup img {
            max-width: 90%;
            max-height: 90%;
            border: 5px solid white;
            border-radius: 10px;
        }
    
        #imagePopup span {
            position: absolute;
            top: 10px;
            right: 20px;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
    


  @endsection

  