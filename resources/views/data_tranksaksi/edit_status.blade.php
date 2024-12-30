@extends('layout.layout_admin.index', ['page' => __('edit_status'), 'pageSlug' => 'edit_status'])

@section('content')


<div class="col-12 grid-margin stretch-card">
    <div class="card" style="width: 700px">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Edit Status</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form class="forms-sample" method="POST" action="{{ route('transaksi.updateStatus', $rental->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="col-lg-12 my-4">
                        <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                            <option value="Belum Dibayar" {{ $rental->status_pembayaran == 'Belum Dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                            <option value="Dibayar" {{ $rental->status_pembayaran == 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="Diproses" {{ $rental->status_pembayaran == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        </select>
                    </div>

                    <div class="col-lg-12 my-4">
                        <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Status Pesanan</label>
                        
                        <select name="status_pesanan" id="status_pesanan" class="form-control" 
                            {{ in_array($rental->status_pesanan, ['Sudah Kembali', 'Dibatalkan']) ? 'disabled' : '' }}
                        >
                        <option value="Belum Diambil" {{ $rental->status_pesanan == 'Belum Diambil' ? 'selected' : '' }}>Belum Diambil</option>
                        <option value="Sudah Kembali" {{ $rental->status_pesanan == 'Sudah Kembali' ? 'selected' : '' }}>Sudah Kembali</option>
                        <option value="Belum Kembali" {{ $rental->status_pesanan == 'Belum Kembali' ? 'selected' : '' }}>Belum Kembali</option>
                        <option value="Dibatalkan" {{ $rental->status_pesanan == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @if(in_array($rental->status_pesanan, ['Sudah Kembali', 'Dibatalkan']))
                            <small class="text-muted">Status pesanan tidak dapat diubah lagi.</small>
                        @endif

                    </div>

                    <button type="submit" class="btn btn-secondary me-2" >Edit</button>
                    <a href="/data_tranksaksi" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>



@endsection