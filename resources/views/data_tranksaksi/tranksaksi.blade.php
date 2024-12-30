@extends('layout.layout_admin.index', ['page' => __('tranksaksi'), 'pageSlug' => 'tranksaksi'])

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-8">
            <h4 class="card-title text-gray-100">Data Tranksaksi</h4>
        </div>
    </div>


<table class="table table-striped table-bordered table-dark">
    <thead class="thead bg-gray-900">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Rental-ID</th>
            <th scope="col">User</th>
            <th scope="col">Total</th>
            <th scope="col">Tgl Pesan</th>
            <th scope="col">Metode Bayar</th>
            <th scope="col">Status Pembayaran</th>
            <th scope="col">Status Pesanan</th>
            <th scope="col">Tgl Sewa</th>
            <th scope="col">Tgl Kembali</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rental as $item)
    
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="h6">{{ $item->id}}</td>
                <td class="h6">{{ $item->user->fullname}}</td>
                <td><span  class="h3" style="font-size: 18px">Rp. {{number_format(($item->total) , 0, ',', '.')}}</span></td>
                
                <td class="h6">
                    @php
                        $tglPesan = \Carbon\Carbon::parse($item->created_at);
                    @endphp
                    {{ $tglPesan->format('Y-m-d') }} <br>
                    <span class="time-below">{{ $tglPesan->format('H:i:s') }}</span>
                </td>
                                
                <td class="h5">{{ $item->metopem->metode_bayar}}</td>
                                    
                <td style="font-weight: bold">
                    <div class="flex-container">
                    <span 
                        class="@if($item->status_pembayaran == 'Belum Dibayar') text-danger 
                                @elseif($item->status_pembayaran == 'Dibayar') text-success
                                @else text-warning
                                @endif">
                                {{ $item->status_pembayaran }}
                    </span>
                    <label>
                        |
                    <a href="editStatus/{{ $item->id }}"
                        class="btn-sm btn-warning text-decoration-none">Edit</a>
                    </label>
                    </div>
                </td>

                <td style="font-weight: bold;">
                    <div class="flex-container">
                    <span 
                        class="@if($item->status_pesanan == 'Belum Kembali') text-danger 
                                @elseif($item->status_pesanan == 'Sudah Kembali') text-success
                                @else text-warning
                                @endif">
                                {{ $item->status_pesanan }}
                    </span>
                    
                    <label>
                        |
                        <a href="editStatus/{{ $item->id }}"
                        class="btn-sm btn-warning" style="text-align: right;" >Edit</a>
                    </label>
                    </div>
                </td>
                                    
                <td class="h6">{{ $item->start_date}}</td>
                <td class="h6">{{ $item->end_date}}</td>
                <td>
                    <div>
                      <a href="{{ route('tranksaksi.detail', $item->id) }}">
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

<style>

        /* Flexbox untuk kolom dengan teks + tombol */
    .flex-container {
            display: flex;
            justify-content: space-between; /* Membuat elemen berjauhan */
            align-items: center; /* Vertikal tengah */
        }


</style>

@endsection