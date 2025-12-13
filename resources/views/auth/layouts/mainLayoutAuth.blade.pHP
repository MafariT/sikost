<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Platform terpercaya untuk mencari dan menyewakan kos">
    <meta name="keywords" content="kos, sewa kos, kamar kos, kost">
    <title>@yield('title', 'SiKos - Platform Sewa Kos Terpercaya')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pemilik.css') }}">

    <style>
        /* Color Variables */
        :root {
            --royal: #334EAC;
            --moon: #F7F2EB;
            --china: #7096D1;
            --asian-pear: #F2F0DE;
            --midnight: #081F5C;
            --dawn: #D0E3FF;
            --jicama: #FFF9F0;
            --porcelain: #EDF1F6;
            --sky: #BAD6EB;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--midnight);
            background-color: var(--porcelain);
            overflow-x: hidden;
        }

        /* Modern Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            padding: 1rem 0;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--royal) !important;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-brand i {
            font-size: 2rem;
            background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--midnight) !important;
            font-weight: 500;
            margin: 0 0.75rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--royal) !important;
            background-color: var(--dawn);
        }

        .nav-link.active {
            color: white !important;
            background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
        }

        /* Auth Buttons */
        .btn-auth {
            padding: 0.625rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-login {
            color: var(--royal);
            border-color: var(--royal);
            background: transparent;
        }

        .btn-login:hover {
            background: var(--royal);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(51, 78, 172, 0.3);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
            color: white;
            border: none;
            box-shadow: 0 5px 15px rgba(51, 78, 172, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(51, 78, 172, 0.4);
        }

        /* Mobile Menu Toggle */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23334EAC' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Footer Styles */
        .footer {
            background: linear-gradient(135deg, var(--midnight) 0%, #0a2466 100%);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h5 {
            font-weight: 700;
            color: var(--dawn);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            line-height: 1.8;
            transition: all 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--dawn);
            padding-left: 5px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: var(--royal);
            transform: translateY(-3px);
            padding-left: 0;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
        }

        .footer-bottom p {
            margin: 0;
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Utility Classes */
        .bg-primary-light { background-color: rgba(51, 78, 172, 0.08) !important; }
        .bg-success-light { background-color: rgba(25, 135, 84, 0.08) !important; }
        .bg-warning-light { background-color: rgba(255, 193, 7, 0.08) !important; }
        .bg-danger-light { background-color: rgba(220, 53, 69, 0.08) !important; }

        .text-primary { color: var(--royal) !important; }
        .text-midnight { color: var(--midnight) !important; }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .nav-link {
                margin: 0.25rem 0;
            }

            .btn-auth {
                width: 100%;
                margin: 0.25rem 0;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-social {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 0.75rem 0;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .footer {
                padding: 2rem 0 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-houses-fill"></i>
                <span>SiKos</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="bi bi-house-door me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#features') }}">
                            <i class="bi bi-stars me-1"></i>Fitur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#contact') }}">
                            <i class="bi bi-chat-dots me-1"></i>Kontak
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-auth btn-login" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-auth btn-register" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-2"></i>Daftar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- About Section -->
                <div class="footer-section">
                    <h5><i class="bi bi-houses-fill me-2"></i>SiKos</h5>
                    <p>Platform terpercaya untuk mencari dan menyewakan kos dengan mudah, aman, dan nyaman.</p>
                    <div class="footer-social">
                        <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" title="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h5>Link Cepat</h5>
                    <ul>
                        <li><a href="{{ url('/') }}"><i class="bi bi-chevron-right me-2"></i>Beranda</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Cari Kos</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Pasang Iklan</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="footer-section">
                    <h5>Bantuan</h5>
                    <ul>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>FAQ</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Syarat & Ketentuan</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Kebijakan Privasi</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-section">
                    <h5>Kontak</h5>
                    <p><i class="bi bi-geo-alt-fill me-2"></i>Jambi City, Indonesia</p>
                    <p><i class="bi bi-envelope-fill me-2"></i>info@sikos.com</p>
                    <p><i class="bi bi-telephone-fill me-2"></i>+62 812-3456-7890</p>
                    <p><i class="bi bi-clock-fill me-2"></i>Senin - Jumat, 09:00 - 18:00</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 SiKos. All rights reserved. Made with <i class="bi bi-heart-fill text-danger"></i> in Indonesia</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 4px 40px rgba(0, 0, 0, 0.12)';
            } else {
                navbar.style.boxShadow = '0 2px 30px rgba(0, 0, 0, 0.08)';
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>