@extends('layout.layout_admin.index', ['page' => __('tambah_metopem'), 'pageSlug' => 'tambah_metopem'])

@section('content')


<div class="row" style="padding-bottom: 10px">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Form Tambah Data Metode Pembayaran</h4>
    </div>
</div>

<div class="col-12 grid-margin stretch-card">
    <div class="card" style="width: 700px">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form class="forms-sample" method="POST" action="create_metopem">
                    @csrf
                    <div class="form-group validate-input " >
                        <label for="nama">Metode Pembayaran</label>
                        <input type="text" class="form-control" id="metode_bayar" name="metode_bayar"  required>
                    </div>
                    <div class="form-group validate-input " >
                        <label for="nama">No.Rekening</label>
                        <input type="text" class="form-control" id="no_rekening" name="no_rekening"  required>
                    </div>
                    <div class="form-group validate-input " >
                        <label for="nama">Atas Nama</label>
                        <input type="text" class="form-control" id="atas_nama" name="atas_nama"  required>
                    </div>
                    <button type="submit" class="btn btn-secondary me-2" >Tambah</button>
                    <a href="/metopem" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>




@endsection
