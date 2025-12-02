<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Link Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Css Penyewa --}}
    <link rel="stylesheet" href="{{ asset('css/penyewa.css') }}">

</head>

<body class="py-8">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
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

    <main>
        @yield('konten')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5>KosKita</h5>
                    <p style="opacity: 0.8;">Platform terpercaya untuk mahasiswa mencari hunian nyaman dan terjangkau di
                        seluruh Indonesia.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5>Perusahaan</h5>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Press Kit</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5>Layanan</h5>
                    <ul>
                        <li><a href="#">Cari Kos</a></li>
                        <li><a href="#">Pasang Iklan</a></li>
                        <li><a href="#">Panduan</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">Lisensi</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Kontak</h5>
                    <ul>
                        <li><a href="#"><i class="fas fa-envelope me-2"></i>info@koskita.id</a></li>
                        <li><a href="#"><i class="fas fa-phone me-2"></i>+62 812-3456-7890</a></li>
                        <li><a href="#"><i class="fas fa-map-marker-alt me-2"></i>Jakarta, Indonesia</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 KosKita. All rights reserved. Made with <i class="fas fa-heart"
                        style="color: #ff6b6b;"></i> for Indonesian Students</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JS Penyewa --}}
    <script src="{{ asset('js/penyewa.js') }}"></script>
</body>

</html>
