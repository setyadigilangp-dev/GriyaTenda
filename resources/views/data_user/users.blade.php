@extends('layout.layout_admin.index', ['page' => __('user'), 'pageSlug' => 'user'])

@section('content')
<div class="row">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Data Kategori</h4>
    </div>
</div>


<table class="table table-striped table-bordered table-dark">
<thead class="thead bg-gray-900">
<tr>
    <th scope="col">No</th>
    <th scope="col">Gambar</th>
    <th scope="col">Nama Lengkap</th>
    <th scope="col">Role</th>
    <th scope="col">Email</th>
    <th scope="col">Action</th>
</tr>
</thead>
<tbody>
    @foreach ($data as $item)

        <tr>
            <td>{{ $loop->iteration }}</td>

            <td><img style="width: 15%;" src="{{asset('storage/account/'.$item->gambar)}}"></td>

            <td>{{ $item->fullname}}</td>

            @if ($item->role === 'admin')
                <td style="color:rgb(0, 255, 0); font-weight: bold;">
                    {{ $item->role }}</td>
            @else
                <td>{{ $item->role }}</td>
            @endif

            <td>{{ $item->email }}</td>

            @if ($item->role === 'admin')
                <td style="color:rgb(0, 255, 0); font-weight: bold;">Admin User</td>
            @else
                <td>
                    <form onsubmit="return confirm('Yakin ingin Mengangkat USER Menjadi ADMIN ?')"
                    class="d-inline" action="/uprole/{{ $item->id }}" method="POST">
                    @csrf
                    <input type="submit"
                    class="btn-sm text-decoration-none border border-warning text-warning" value="UP">
                    </form>
                </td>
            @endif  
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
