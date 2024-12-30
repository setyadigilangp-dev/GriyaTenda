@extends('layout.layout_admin.index', ['page' => __('question'), 'pageSlug' => 'question'])

@section('content')
<div class="row">
    <div class="col-8">
        <h4 class="card-title text-gray-100">Data Question</h4>
    </div>
</div>


<table class="table table-striped table-bordered table-dark">
<thead class="thead bg-gray-900">
<tr>
<th scope="col">No</th>
<th scope="col">Nama</th>
<th scope="col">Email</th>
<th scope="col">Judul</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
    @foreach ($data as $item)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama}}</td>
            <td>{{ $item->email}}</td>
            <td>{{ $item->judul}}</td>
            <td>
                <div>
                  <a href="detailQuestion/{{ $item->id }}">
                    <i class="fas fa-solid fa-eye" style="width:24px; height:24px; color:limegreen; margin-left:4vh;"></i>
                  </a>
                  <h6 style="margin-left: 3vh;">
                    Detail
                  </h6>
                  
                </div>
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
