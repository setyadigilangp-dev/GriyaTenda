@extends('layout.layout_admin.index', ['page' => __('detail_question'), 'pageSlug' => 'detail_question'])

@section('content')


<div class="col-12 grid-margin stretch-card">
    <div class="card" style="width: 700px">
        <div class="card-body">

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ $data->nama }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $data->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ $data->judul }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pesan</label>
                        <textarea name="pesan" id="pesan" style="overflow-y: auto; height: 100px; width:100%;" disabled>{{ $data->pesan }}</textarea>
                    </div>

                    <a href="/showQuestion" class="btn btn-light">Kembali</a>
        </div>
    </div>
</div>



@endsection