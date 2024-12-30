@extends('layout.layout_admin.index', ['page' => __('edit_kategori'), 'pageSlug' => 'edit_kategori'])

@section('content')


<div class="col-12 grid-margin stretch-card">
    <div class="card" style="width: 700px">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Edit Data Kategori</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form class="forms-sample" method="POST" action="/update_kategori">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="nama">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                            value="{{ $data->nama_kategori }}" required>
                    </div>
                    <button type="submit" class="btn btn-secondary me-2" >Edit</button>
                    <a href="/kategori" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>



@endsection