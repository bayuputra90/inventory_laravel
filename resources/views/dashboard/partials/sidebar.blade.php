<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item @if(Request::is('home')) active @endif">
                <a class="sidebar-link" href="{{ url('home') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header ">
                Data
            </li>

            <li class="sidebar-item @if(Request::is('kategori*')) active @endif">
                <a class="sidebar-link" href="{{ url('kategori') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Kategori</span>
                </a>
            </li>
            <li class="sidebar-item @if(Request::is('barang*')) active @endif">
                <a class="sidebar-link" href="{{ url('barang') }}">
                    <i class="align-middle" data-feather="box"></i> <span class="align-middle"> Barang</span>
                </a>
            </li>

            <li class="sidebar-header ">
                Barang
            </li>

            <li class="sidebar-item @if(Request::is('permohonan*')) active @endif">
                <a class="sidebar-link" href="{{ route('permohonan.index') }}">
                    <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Permohonan Barang</span>
                </a>
            </li>
            <li class="sidebar-item @if(Request::is('pengadaan*')) active @endif">
                <a class="sidebar-link" href="{{ route('pengadaan.index') }}">
                    <i class="align-middle" data-feather="table"></i> <span class="align-middle">Pengadaan Barang</span>
                </a>
            </li>

            <li class="sidebar-header ">
                Tata Usaha
            </li>

            <li class="sidebar-item @if(Request::is('validasi*')) active @endif">
                <a class="sidebar-link" href="{{ route('validasi.index') }}">
                    <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Validasi</span>
                </a>
            </li>

            <li class="sidebar-header ">
                Akun
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
