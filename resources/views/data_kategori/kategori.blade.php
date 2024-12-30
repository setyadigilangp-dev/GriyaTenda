@extends('layout.layout_admin.index', ['page' => __('kategori'), 'pageSlug' => 'kategori'])

@section('content')
<div class="row">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Data Kategori</h4>
    </div>
    <div class="col-4 text-right">
        <a href="{{ route('tambahkategori')  }}" class="btn btn-sm btn-light">Tambah Data</a>
    </div>
</div>


<table class="table table-striped table-bordered table-dark">
<thead class="thead bg-gray-900">
<tr>
<th scope="col">No</th>
<th scope="col">Nama Kategori</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
    @foreach ($data as $item)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_kategori}}</td>
            <td><a href="kategori_edit/{{ $item->id }}"
                class="btn-sm btn-warning text-decoration-none">Edit</a> |
            <form onsubmit="return confirmHapus(event)"
                action="kategori_hapus/{{ $item->id }}" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn-sm btn-danger">Hapus</button>
            </form>
        </td>
        </tr>
    
    @endforeach
</tbody>
</table>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmHapus(event) {
        event.preventDefault(); // Menghentikan form dari pengiriman langsung

        Swal.fire({
            title: 'Yakin Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                event.target.submit(); // Melanjutkan pengiriman form
            } else {
                swal('Your imaginary file is safe!');
            }
        });
    }
</script>
