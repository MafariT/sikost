<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/beranda">SiKos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('beranda') ? 'active' : '' }}" href="/beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('fitur') ? 'active' : '' }}" href="/fitur">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kos') ? 'active' : '' }}" href="/kos">Kos Populer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang</a>
                </li>
                <li class="nav-item ms-3">
                    <button class="btn btn-primary-custom">Daftar Sekarang</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
