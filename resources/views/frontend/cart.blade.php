@extends('layout.layout_user.index', ['page' => __('detail_perlengkapan'), 'pageSlug' => 'detail_perlengkapan'])

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
            <h2 class="page-title display-3 mt-5">rent cart</h2>
            <nav class="breadcrumb">
              <a class="breadcrumb-item" href="{{ route('dashboard')  }}">Home</a>
              <span class="breadcrumb-item active" aria-current="page">Rent Cart</span>
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
                            <div class="col" style="margin-bottom: -38px;"><h5><b>Keranjang Sewa</b></h5></div>
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
                              <th scope="col">Hapus</th>
                            </tr>
                          </thead>
                    
                    
                        <tbody style="justify-content: center; vertical-align:middle; border:none;">
                            @foreach ($cart as $item)
                        
                                <tr style="text-align: center; background-color:white;">
                                    <td><img class="" style="width: 100px;" src="{{asset('storage/barang/'.$item->barang->gambar)}}"></td>
                                    <td>{{ $item->barang->nama_barang}}</td>
                                    <td><form action="{{ route('kurang_jml', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" style="background-color: black; color:white;" class="btn btn-sm">-</button>
                                    </form>
                                    
                                        <a href="#" class="border-cart">{{ $item->jumlah}}</a>
                                    
                                    <form action="{{ route('tambah_jml', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->barang->product_id }}">
                                        <!-- Input untuk jumlah produk -->
                                        <input type="hidden" name="jumlah" value="1" min="1" id="jumlah" required>
                                        <button type="submit" style="background-color: black; color:white;" class="btn btn-sm">+</button>
                                    </form>
                                    </td>
                                    <td><h3 class="pt-2" style="font-size: 15px">Rp. {{ number_format(($item->barang->harga_sewa)*($item->jumlah), 0, ',', '.') }}</h3></td>
                                    <td><form onsubmit="return confirmHapus(event)" action="hapuscart/{{ $item->id }}" method="post" class="d-inline">
                                        @csrf
                                            <button class="icon-btn" type="submit">
                                                <iconify-icon icon="tabler:trash-x" width="24" height="24"  style="color: black"></iconify-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        

                    
                </div>
                
                    <div class="col-md-4 summary-cart" style="height: 80vh;">
                        <form action="{{ route('rental') }}" method="POST">
                            @csrf
                        <div style="padding-bottom: 7px;"><h5><b>Detail Sewa</b></h5></div>
                        <hr style="color:black">
                        
                            <!-- Hidden input untuk mengirimkan data ke order -->
                        @foreach($cart as $item)

                            <input type="hidden" name="jumlah[]" value="{{ $item->jumlah }}">

                        @endforeach

                        <div class="col-lg-12 my-4">
                            <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Tanggal Mengambil Barang</label>
                            <div class="input-group date" id="datepicker">
                            <input type="date" id="start_date" name="start_date" min="2023-01-01" max="2025-12-31"
                                class="form-control ps-3">
                            </div>
                        </div>

                        <div class="col-lg-12 my-4">
                            <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Tanggal Mengembalikan Barang</label>
                            <div class="input-group date" id="datepicker">
                            <input type="date" id="end_date" name="end_date" min="2023-01-01" max="2025-12-31"
                                class="form-control ps-3">
                            </div>
                        </div>

                        <div class="col-lg-12 my-4">
                            <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Metode Pembayaran</label>
                            <select class="form-select form-control p-2" id="metode_bayar_id" name="metode_bayar_id" aria-label="Default select example" style="background-image: none;">
                                <option value="" style="text-align: center">Pilih Metode Pembayaran</option>
                                @foreach($metopem as $pay)
                                    <option value="{{ $pay->id }}" {{ request('metode_bayar_id') == $pay->id ? 'selected' : '' }} style="text-align: center">{{ $pay->metode_bayar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="totalHarga" value="{{ $totalPrice ?? 0 }}">
                        <hr style="color: black">
                        
                        
                        <div>
                            <h3 class="pt-2" style="font-size: 20px" id="total-price">Total : Rp. 0</h3>
                        </div>
                           
                        <button type="submit" class="btn-cart">CHECKOUT</button>
                    </form>
                    </div>
                
        </div>
    
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.querySelector('input[name="start_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');
        const totalPriceElement = document.querySelector('#total-price');

            // Fungsi untuk memformat angka menjadi format "Rp. 1.000.000"
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number).replace('IDR', 'Rp').trim();
        }

        function updateTotalPrice() {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            

            if (startDate && endDate) {
                fetch('/calculate-total', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        start_date: startDate,
                        end_date: endDate
                    })
                })
                .then(response => response.json())
                .then(data => {
                    totalPriceElement.textContent = `Total : ${formatRupiah(data.totalPrice)}`;
                })
                .catch(error => console.error('Error:', error));
            }
        }

        startDateInput.addEventListener('change', updateTotalPrice);
        endDateInput.addEventListener('change', updateTotalPrice);
    });
</script>



@endsection