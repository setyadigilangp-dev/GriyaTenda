@extends('layout.layout_user.index', ['page' => __('data_pesanan'), 'pageSlug' => 'data_pesanan'])

@section('content')



  <!-- Product section-->
        <section class="py-5">
            <div class="container px-5 px-lg-5 my-5" style="border: 2px solid #828181; box-shadow: 10px 10px 15px #a1a1a1;);border-radius: 9px;">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-lg-12 cart-cart" style="overflow: auto; height: 750px;">

                        <table class="table" style="margin-top:-2%;">
                          <thead class="thead" style="border-bottom: 3px solid">
                              <tr style="text-align: center; border:">
                                <th scope="col">No</th>
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
                            

                            <tbody style="justify-content: center; vertical-align:middle; border:none;">

                              @foreach ($rental as $item)
                        
                                <tr style="text-align: center; background-color:white;">
                                    <td class="h6">{{ $loop->iteration }}</td>
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
                                      <span 
                                          class="
                                              @if($item->status_pembayaran == 'Belum Dibayar') text-danger 
                                              @elseif($item->status_pembayaran == 'Dibayar') text-success
                                              @else text-warning
                                              @endif
                                          ">
                                          {{ $item->status_pembayaran }}
                                      </span>
                                    </td>
                                    <td style="font-weight: bold">
                                      <span 
                                          class="
                                              @if($item->status_pesanan == 'Belum Kembali') text-danger 
                                              @elseif($item->status_pesanan == 'Sudah Kembali') text-success
                                              @else text-warning
                                              @endif
                                          ">
                                          {{ $item->status_pesanan }}
                                      </span>
                                    </td>
                                    
                                    <td class="h6">{{ $item->start_date}}</td>
                                    <td class="h6">{{ $item->end_date}}</td>
                                    <td style="align-items: center">
                                      <div>
                                        <a href="{{ route('rental.detail', $item->id) }}">
                                          <iconify-icon icon="zondicons:view-show" width="24" height="24"  style="color:limegreen"></iconify-icon>
                                        </a>
                                        <h6>Detail</h6>
                                      </div>
                                  </td>

                                
                                </tr>
                              @endforeach

                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
        </section>


  @endsection

  