<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-solid fa-campground"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Griya Tenda</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard')  }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang')  }}">
            <i class="fas fa-solid fa-briefcase"></i>
            <span>Data Barang</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kategori')  }}">
            <i class="fas fa-solid fa-tag"></i>
            <span>Data Kategori</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('metopem')  }}">
            <i class="fas fa-solid fa-tag"></i>
            <span>Data Metode Bayar</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users')  }}">
            <i class="fas fa-solid fa-user"></i>
            <span>Data User</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('data_tranksaksi')  }}">
            <i class="fas fa-solid fa-money-bill"></i>
            <span>Data Tranksaksi</span></a>
    </li>
     <!-- Divider -->
     <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('showQuestion')  }}">
           <i class="fas fa-solid fa-envelope"></i>
            <span>Data Question</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>