<style>
    /* Responsive */
    @media (max-width: 768px) {
        .logout-btn {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem;
            font-size: 1rem;
            border-radius: 10px;
            /* biar cantik */
            padding: 0.9rem 0;
        }
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

        <a class="navbar-brand" href="/beranda">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 40px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('beranda') ? 'active' : '' }}" href="/beranda">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kamar') ? 'active' : '' }}" href="/kamar">Kamar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('riwayat') ? 'active' : '' }}" href="/riwayat">Riwayat</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profil') ? 'active' : '' }}" href="/profil">Profil</a>
                </li>

                <!-- Logout Button -->
                <li class="nav-item ms-3 d-none d-lg-block">
                    <form action="">
                        @csrf
                        <button class="btn btn-danger d-flex align-items-center gap-2">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>

            <!-- MOBILE LOGOUT -->
            <div class="d-lg-none w-100 mt-3">
                <hr>
                <form action="">
                    @csrf
                    <button class="btn btn-danger w-100 logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>

        </div>

    </div>
</nav>
