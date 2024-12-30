@extends('layout.layout_admin.index', ['page' => __('tranksaksi'), 'pageSlug' => 'tranksaksi'])

@section('content')
        <div class="page-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title text-gray-100">Data Tranksaksi</h4>
                </div>
            </div>
        </div>

            <section class="card-cart" style="margin-top: 10px; margin-bottom: 10px;">
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

                            <div class="col-lg-12 my-4">

                              <label style="display: block;" for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Bukti Pembayaran</label>

                                {{-- Logika berdasarkan kondisi --}}
                                  @if ($rental->bukti_pembayaran)
                                  {{-- Jika bukti pembayaran tersedia --}}
                                    <!-- Link untuk membuka gambar -->
                                  <a href="javascript:void(0);" onclick="showImagePopup('{{ asset('storage/bukti_pembayaran/' . $rental->bukti_pembayaran) }}')" style="color: royalblue; display:block; text-decoration: underline;" class="link-custom">Lihat Bukti Pembayaran</a>
                              @else
                                  {{-- Jika bukti pembayaran kosong --}}
                                  @if ($rental->status_pesanan == 'Dibatalkan' && $rental->status_pembayaran == 'Belum Dibayar')
                                      <p class="text-danger">Pesanan ini sudah dibatalkan.</p>
                                  @elseif ($rental->status_pembayaran == 'Belum Dibayar')
                                      <p class="text-success">User belum mengupload bukti pembayaran.</p>
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

  /* rent cart */

body.cart{
  background: #ddd;
  min-height: 500vh;
  vertical-align: middle;
  display: flex;
  font-family: sans-serif;
  font-size: 0.8rem;
  font-weight: bold;
}
.title-cart{
  margin-bottom: 5vh;
}
.card-cart{
  margin: auto;
  max-width: 80%;
  max-height: 500vh;
  height: 80vh;
  box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  border-radius: 1rem;
  border: transparent;
}
@media(max-width:767px){
  .card-cart{
      margin: 3vh auto;
  }
}
.cart-cart{
  background-color: #fff;
  padding: 4vh 5vh;
  border-bottom-left-radius: 1rem;
  border-top-left-radius: 1rem;
}
@media(max-width:767px){
  .cart-cart{
      padding: 4vh;
      border-bottom-left-radius: unset;
      border-top-right-radius: 1rem;
  }
}
.summary-cart{
  background-color: #ddd;
  border-top-right-radius: 1rem;
  border-bottom-right-radius: 1rem;
  padding: 4vh;
  color: rgb(65, 65, 65);
}
@media(max-width:767px){
  .summary-cart{
  border-top-right-radius: unset;
  border-bottom-left-radius: 1rem;
  }
}
.summary-cart .col-2{
  padding: 0;
}
.summary-cart .col-10
{
  padding: 0;
}.row{
  position: relative;
  width: 100%;
  margin: 0;
}
.title-cart b{
  font-size: 1.5rem;
}
.main-cart{
  margin: 0;
  padding: 2vh 0;
  width: 100%;
}
.col-2, .col{
  padding: 0 1vh;
}
a{
  padding: 0 1vh;
}
.close-cart{
  margin-left: auto;
  font-size: 0.7rem;
}
.back-to-shop-cart{
  margin-top: 4.5rem;
}
h5.cart{
  margin-top: 4vh;
}
hr.cart{
  margin-top: 1.25rem;
}
form.cart{
  padding: 2vh 0;
}
select.cart{
  border: 1px solid rgba(0, 0, 0, 0.137);
  padding: 1.5vh 1vh;
  margin-bottom: 4vh;
  outline: none;
  width: 100%;
  background-color: rgb(247, 247, 247);
}
input.cart{
  border: 1px solid rgba(0, 0, 0, 0.137);
  padding: 1vh;
  margin-bottom: 4vh;
  outline: none;
  width: 100%;
  background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
    color:transparent;
}
.btn-cart{
  background-color: #000;
  border-color: #000;
  color: white;
  width: 100%;
  font-size: 0.7rem;
  margin-top: 22vh;
  padding: 1vh;
  border-radius: 0;
}

.btn-cart:hover{
  color: white;
}
a{
  color: black; 
}
a:hover{
  color: black;
  text-decoration: none;
}
#code{
  background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
  background-repeat: no-repeat;
  background-position-x: 95%;
  background-position-y: center;
}
.icon-btn {
  background-color: #fdfdfd; /* Warna background hijau */
  color: white; /* Warna teks putih */
  border: none; /* Menghilangkan border */
  padding: 0px 0px; /* Padding */
  text-align: center; /* Posisi teks */
  text-decoration: none; /* Menghilangkan garis bawah */
  display: inline-block; /* Agar berada di satu baris */
  font-size: 16px; /* Ukuran font */
  border-radius: 5px; /* Membuat sudut tumpul */
  cursor: pointer; /* Menambahkan pointer pada hover */
  transition: background-color 0.3s ease; /* Animasi transisi */
}

/* Hover efek untuk button */
.icon-btn:hover {
  background-color: #ffffff;
}

/* Ikon di dalam button */
.icon-btn .fa {
  margin-right: 0px; /* Jarak ikon dengan teks */
}

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}

.table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}
.table th, .table td {
  padding: 10px;
  text-align: center;
  vertical-align: middle;
  border-bottom: 1px solid #ddd;
}
.table th {
  background-color: white;
  font-weight: bold;
}
@media (max-width: 768px) {
  .table-responsive {
      overflow-x: auto;
  }
}
.table tbody tr:hover {
  background-color: #f1f1f1;
}

.link-wrapper {
    margin: 0; /* Hapus margin dari div */
    padding: 0; /* Hapus padding dari div */
    text-align: left; /* Pastikan konten rata kiri */
}

.link-custom {
    margin: 0; /* Hapus margin dari link */
    padding: 0; /* Hapus padding dari link */
    color: royalblue; /* Warna teks */
    text-decoration: underline; /* Garis bawah */
    display: block; /* Buat link mematuhi properti block */
    text-align: left; /* Teks rata kiri */
}


</style>

@endsection