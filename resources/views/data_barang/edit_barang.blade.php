@extends('layout.layout_admin.index', ['page' => __('tambah_barang'), 'pageSlug' => 'tambah_barang'])

@section('content')


<div class="row" style="padding-bottom: 10px">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Form Edit Data Barang</h4>
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
                <form class="forms-sample" method="POST" action="{{ route('update_barang', ['id' => $data->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group validate-input " >
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"  value="{{ $data->nama_barang }}"required>
                    </div>
                    <div class="form-group row border-bottom pb-4">
                        <label>Kategori:</label>
                        <select class="form-control" id="nama_kategori" name="categories_id">
                            <option value="">- Pilih -</option>
                            @foreach($kategori as $item)
                             <option value="{{ $item->id }}" {{ old('categories_id') == $item->id ? 'selected' : null }}>{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stok:</label>
                        <input type="text" class="form-control" name="stok" value="{{ $data->stok }}">
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa:</label>
                        <input type="text" class="form-control" name="harga_sewa" value="{{ $data->harga_sewa }}">
                    </div>
                    <div class="form-group">
                        <label>Denda Rusak:</label>
                        <input type="text" class="form-control" name="denda_rusak" value="{{ $data->denda_rusak }}">
                    </div>
                    <div class="form-group">
                        <label>Denda Hilang:</label>
                        <input type="text" class="form-control" name="denda_hilang" value="{{ $data->denda_hilang }}">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control-file border" name="gambar" id="gambar" value="{{ $data->gambar }}">
                        <br>
                    </div>
                    

                    <button type="submit" class="btn btn-secondary me-2" >Edit</button>
                    <a href="/kategori" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>




@endsection
