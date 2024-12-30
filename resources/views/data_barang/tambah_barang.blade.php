@extends('layout.layout_admin.index', ['page' => __('tambah_barang'), 'pageSlug' => 'tambah_barang'])

@section('content')


<div class="row" style="padding-bottom: 10px">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Form Tambah Data Barang</h4>
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
                <form class="forms-sample" method="POST" action="create_barang" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group validate-input " >
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_barang"  required>
                    </div>
                    <div class="form-group row border-bottom pb-4">
                        <label>Kategori:</label>
                        <select class="form-control" name="categories_id">
                            <option value="">- Pilih -</option>
                            @foreach($kategori as $item)
                             <option value="{{ $item->id }}" {{ old('categories_id') == $item->id ? 'selected' : null }}>{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stok:</label>
                        <input type="text" class="form-control" name="stok">
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa:</label>
                        <input type="text" class="form-control" name="harga_sewa">
                    </div>
                    <div class="form-group">
                        <label>Denda Rusak:</label>
                        <input type="text" class="form-control" name="denda_rusak">
                    </div>
                    <div class="form-group">
                        <label>Denda Hilang:</label>
                        <input type="text" class="form-control" name="denda_hilang">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control-file border" name="gambar" id="gambar">
                        <br>
                    </div>
                    

                    <button type="submit" class="btn btn-secondary me-2" >Tambah</button>
                    <a href="/kategori" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>




@endsection
