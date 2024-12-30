@extends('layout.layout_admin.index', ['page' => __('barang'), 'pageSlug' => 'barang'])

@section('content')
        
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title text-gray-100">Data Barang</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('tambahbarang')  }}" class="btn btn-sm btn-light">Tambah Data</a>
                    </div>
                </div>
            

  <table class="table table-striped table-bordered table-dark">
    <thead class="thead bg-gray-900">
      <tr style="text-align: center">
        <th scope="col">No</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Kategori</th>
        <th scope="col">Stok</th>
        <th scope="col">Harga Sewa</th>
        <th scope="col">Denda Rusak</th>
        <th scope="col">Denda Hilang</th>
        <th scope="col">Gambar</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody style="justify-content: center">
      @foreach ($data as $item)
  
          <tr style="text-align: center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama_barang}}</td>
              <td>{{ $item->kategori->nama_kategori }}</td>
              <td>{{ $item->stok}}</td>
              <td>Rp.{{number_format($item->harga_sewa)}} /24 jam</td>
              <td>Rp.{{number_format($item->denda_rusak)}}</td>
              <td>Rp.{{number_format($item->denda_hilang)}}</td>
              <td><img style="width: 100px;" src="{{asset('storage/barang/'.$item->gambar)}}"></td>
              <td><a href="barang_edit/{{ $item->id }}"
                  class="btn-sm btn-warning text-decoration-none">Edit</a> |
              <form onsubmit="return confirmHapus(event)"
                  action="barang_hapus/{{ $item->id }}" method="post" class="d-inline">
                  @csrf
                  <button type="submit" class="btn-sm btn-danger">Hapus</button>
              </form>
          </td>
          </tr>
      
      @endforeach
  </tbody>
  </table>

            
@endsection