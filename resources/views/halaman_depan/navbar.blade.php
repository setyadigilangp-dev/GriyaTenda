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
                            <a class="nav-link px-3" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('auth') }}">Sewa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('kontak_depan')  }}">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('tentangkami_depan')  }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ route('auth') }}">Login</a>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
