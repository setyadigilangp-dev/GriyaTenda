@extends('layout.layout_admin.index', ['page' => __('tambah_kategori'), 'pageSlug' => 'tambah_kategori'])

@section('content')


<div class="row" style="padding-bottom: 10px">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Form Tambah Data Kategori</h4>
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
                <form class="forms-sample" method="POST" action="create_kategori">
                    @csrf
                    <div class="form-group validate-input " >
                        <label for="nama">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"  required>
                    </div>
                    <button type="submit" class="btn btn-secondary me-2" >Tambah</button>
                    <a href="/kategori" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>




@endsection
