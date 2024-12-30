@extends('layout.layout_admin.index', ['page' => __('edit_metopem'), 'pageSlug' => 'edit_metopem'])

@section('content')


<div class="col-12 grid-margin stretch-card">
    <div class="card" style="width: 700px">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Edit Data Metode Pembayaran</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form class="forms-sample" method="POST" action="/update_metopem">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="nama">Metode Pembayaran</label>
                        <input type="text" class="form-control" id="metode_bayar" name="metode_bayar"
                            value="{{ $data->metode_bayar }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">No.Rekening</label>
                        <input type="text" class="form-control" id="no_rekening" name="no_rekening"
                            value="{{ $data->no_rekening }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Atas Nama</label>
                        <input type="text" class="form-control" id="atas_nama" name="atas_nama"
                            value="{{ $data->atas_nama }}" required>
                    </div>
                    <button type="submit" class="btn btn-secondary me-2" >Edit</button>
                    <a href="/metopem" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>



@endsection