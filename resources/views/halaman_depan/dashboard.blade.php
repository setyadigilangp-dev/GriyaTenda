@extends('halaman_depan.index', ['page' => __('dashboard'), 'pageSlug' => 'dashboard'])

@section('content')


    <!-- hero section start  -->
    <section id="hero" class=" position-relative overflow-hidden">
        <div class="pattern-overlay pattern-right position-absolute">
            <img src="{{asset ('frontend/images/hero-pattern-right.png')}}" alt="pattern">
        </div>
        <div class="pattern-overlay pattern-left position-absolute">
            <img src="{{asset ('frontend/images/hero-pattern-left.png')}}" alt="pattern">
        </div>
        <div class="hero-content container text-center">
            <div class="row">
                <div class="detail mb-4">
                    <h1 class="">Cari perlengkapan<span class="text-primary"> adventure kamu.</span> </h1>
                    <p class="hero-paragraph">Kami memiliki banyak koleksi perlengkapan adventure terbaik yang dapat anda sewa.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- process section start  -->
    <section id="process">
        <div class=" process-content container">
            <h2 class=" text-center my-5 pb-5">Proses <span class="text-primary"> penyewaan </span> </h2>
            <hr class="progress-line">
            <div class="row process-block">
                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> Pilih perlengkapanmu </h5>
                    
                </div>

                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> selesaikan pembayaran </h5>
                    
                </div>

                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> ambil di lokasi Griya Tenda Adventure </h5>
                    
                </div>

                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> Proses Selesai </h5>
                    
                </div>

            </div>


        </div>
    </section>


    <!-- pricing section start  -->
    <section id="pricing">
        <div class=" container  py-5 my-5">
            <h2 class=" text-center my-5">Paket Hemat <span class="text-primary">Camping</span> </h2>

            


            <div class="row py-4">
                <div class="  col-lg-3 col-sm-6 col-12 pb-4">
                    <div class=" pricing-lable pt-5 ">
                        <div class="pt-3 ps-2">
                            <h3>Ingin lebih hemat ?</h3>
                            <p>Kami menyediakan beberapa paket hemat dengan 3 paket, silahkan pilih dengan menyesuaikan anggota camping</p>
                        </div>
                            <iconify-icon class="pricing-lable-icon " icon="game-icons:camping-tent"></iconify-icon>
                    </div>
                </div>

                <div class=" col-lg-3 col-sm-6 col-12 pb-4">
                    <div class=" pricing-detail py-5  text-center">
                        <div class="pricing-content">
                            <h5>Bucin</h5>

                            <div class="content monthly pt-2">
                                <h3 style="font-size: 30px">Rp.100.000,- / day</h3>
                            </div>

                            <div class="pt-4">
                                <p>✓ Tenda 2 orang (1)</p>
                                <p>✓ Nesting (1)</p>
                                <p>✓ Kompor Bulat (1)</p>
                                <p>✓ Lampu Tenda (1)</p>
                                <p>✓ Matras (2)</p>
                            </div>

                        </div>

                        <form action="{{ route('auth') }}" method="POST">
                            @csrf
                            <div class="pricing-button">
                                <button type="submit" class="btn btn-primary">Pilih Paket</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class=" col-lg-3 col-sm-6 col-12 pb-4">
                    <div class=" pricing-detail py-5  text-center">
                        <div class="pricing-content">
                            <h5 class="price-recommend">Mabar</h5>
                            <div class="content monthly pt-2">
                                <h3 style="font-size: 30px">Rp.140.000,- / day</h3>
                            </div>

                            <div class="pt-4">
                                <p>✓ Tenda 4-5 orang (1)</p>
                                <p>✓ Nesting (1)</p>
                                <p>✓ Kompor Bulat (1)</p>
                                <p>✓ Lampu Tenda (1)</p>
                                <p>✓ Matras (2)</p>
                            </div>

                        </div>

                        <form action="{{ route('auth') }}" method="POST">
                            @csrf
                            <div class="pricing-button">
                                <button type="submit" class="btn btn-primary">Pilih Paket</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class=" col-lg-3 col-sm-6 col-12 pb-4">
                    <div class=" pricing-detail py-5  text-center">
                        <div class="pricing-content">
                            <h5>Rombongan</h5>
                            <div class="content monthly pt-2">
                                <h3 style="font-size: 30px">Rp.250.000,- / day</h3>
                            </div>

                            <div class="pt-4">
                                <p>✓ Tenda 4-5 orang (2)</p>
                                <p>✓ Nesting (2)</p>
                                <p>✓ Kompor Bulat (2)</p>
                                <p>✓ Lampu Tenda (2)</p>
                                <p>✓ Matras (4)</p>
                            </div>

                        </div>

                        <form action="{{ route('auth') }}" method="POST">
                            @csrf
                            <div class="pricing-button">
                                <button type="submit" class="btn btn-primary">Pilih Paket</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>


        </div>
    </section>
        <!-- end-content  -->

@endsection