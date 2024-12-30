@extends('layout.layout_admin.index', ['page' => __('edit_user'), 'pageSlug' => 'edit_user'])

@section('content')


<div class="row" style="padding-bottom: 10px">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Form Edit Profile</h4>
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
                <form class="forms-sample" method="POST" action="{{ route('update_user', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="form-group validate-input " >
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" id="fullname"  value="{{ $user->fullname }}"required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Nomor WA</label>
                        <input type="text" class="form-control" name="nomor_wa" id="nomor_wa" value="{{ $user->nomor_wa }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $user->alamat }}">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control-file border" name="gambar" id="gambar" value="{{ $user->gambar }}">
                        <br>
                    </div>
                    

                    <button type="submit" class="btn btn-secondary me-2" >Edit</button>
                    <a href="/dashboard" class="btn btn-light">Kembali</a>
                </form>
        </div>
    </div>
</div>


<script>
    function showHide() {
      var inputan = document.getElementById("password");
      if (inputan.type === "password") {
        inputan.type = "text";
      } else {
        inputan.type = "password";
      }
    } 
</script>

@endsection
