<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Link Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- CSS Pemilik --}}
    <link rel="stylesheet" href="{{ asset('css/pemilik.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#dashboard-section">
                SiKos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavPemilik">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavPemilik">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#dashboard-section">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kamar-section">
                            <i class="fas fa-door-closed me-1"></i>Kamar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pembayaran-section">
                            <i class="fas fa-money-bill-wave me-1"></i>Pembayaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#keluhan-section">
                            <i class="fas fa-exclamation-circle me-1"></i>Keluhan
                        </a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-logout" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid">
        <div class="container">
            @yield('konten')
        </div>
    </main>

    <!-- Footer Sederhana -->
    <footer class="footer-simple">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h5>SiKos</h5>
                </div>
                <div class="footer-copyright">
                    <p>&copy; 2025 SiKos. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JS Pemilik --}}
    <script src="{{ asset('js/pemilik.js') }}"></script>
    
    {{-- Smooth scroll untuk anchor links --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if(targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                            link.classList.remove('active');
                        });
                        this.classList.add('active');
                        
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            window.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('.pemilik-dashboard section, [id$="-section"]');
                const navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.btn)');
                
                let currentSection = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 100;
                    const sectionHeight = section.clientHeight;
                    
                    if(scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                        currentSection = '#' + section.id;
                    }
                });
                
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if(link.getAttribute('href') === currentSection) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>

</html>