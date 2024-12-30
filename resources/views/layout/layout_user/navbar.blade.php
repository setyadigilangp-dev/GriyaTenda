<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">

    <nav class="navbar navbar-expand-lg  navbar-light container-fluid py-3 position-fixed ">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img src="{{asset ('frontend/images/logo.png')}}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav align-items-center justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('home_client')  }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('sewa')  }}">Sewa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('kontak')  }}">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('tentangkami')  }}">Tentang Kami</a>
                        </li>
                        <li style="padding-left: 22%">
                            <a href="{{ route('data_pesanan') }}">
                                <iconify-icon icon="mingcute:paper-line" width="24" height="24"  style="color: black"></iconify-icon>
                            </a>
                        </li>
                        <div class="divider" style="border-right: 1px solid #000000; height: calc(4.375rem - 2rem); margin: auto 1rem "></div>
                        <li>
                        <a href="{{ route('showcart') }}">
                        <iconify-icon icon="mdi:cart" width="24" height="24"  style="color: black; "></iconify-icon>
                        </a>
                        </li>
                        <div class="divider" style="border-right: 1px solid #000000; height: calc(4.375rem - 2rem); margin: auto 1rem "></div>
                        <li class="nav-item dropdown text-center">
                            <a class="nav-link px-3 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" href="#">
                                <span class="mr-2 d-none d-lg-inline text-gray-100 small">{{ Auth::user()->fullname }}</span>
                                <img class="" src="{{ asset('storage/account/'. auth::user()->gambar) }}" style="height: 2rem; width: 2rem; border-radius: 50% !important;"> 
                                <iconify-icon icon="material-symbols:arrow-drop-down"></iconify-icon></a>
                            <ul class="dropdown-menu">
                              <li><a href="editProfile/{{ auth::user()->id }}" class="dropdown-item text-uppercase ">Profile</a></li>
                              
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item text-uppercase" type="submit">Logout</button>
                            </form>
                            </ul>
                          </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
