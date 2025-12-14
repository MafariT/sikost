@extends('auth.layouts.main-layout-auth')

@section('content')
<div class="login-container">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <!-- Left Side - Login Form -->
            <div class="col-lg-5 col-md-8" data-aos="fade-right">
                <div class="login-card">
                    <div class="text-center mb-4">
                        <div class="login-icon mb-3">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h2 class="fw-bold text-midnight mb-2">Selamat Datang Kembali!</h2>
                        <p class="text-muted">Masuk untuk melanjutkan pencarian kos impianmu</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Berhasil!</strong> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Oops!</strong> Email atau password salah.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill me-2 text-primary"></i>Email
                            </label>
                            <div class="input-group">
                                <input id="email" type="email" name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                                @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="password" class="form-label fw-semibold mb-0">
                                    <i class="bi bi-lock-fill me-2 text-primary"></i>Password
                                </label>
                                <a href="{{ route('password.request') }}"
                                    class="text-primary text-decoration-none small fw-semibold forgot-link">
                                    Lupa Password?
                                </a>
                            </div>
                            <div class="input-group">
                                <input id="password" type="password" name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                @error('password')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-4">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">
                                <span class="fw-semibold">Ingat Saya</span>
                                <small class="text-muted d-block">Tetap masuk untuk 30 hari</small>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                                    Daftar Sekarang <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side - Illustration/Benefits -->
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
                <div class="login-info">
                    <div class="info-header mb-5">
                        <div class="icon-wrapper mb-4">
                            <i class="bi bi-house-heart-fill"></i>
                        </div>
                        <h1 class="display-4 fw-bold text-midnight mb-3">Mulai Perjalananmu Mencari Kos</h1>
                        <p class="lead text-muted">Ribuan pilihan kos terbaik menunggumu</p>
                    </div>

                    <!-- Stats/Benefits -->
                    <div class="stats-grid">
                        <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="stat-icon bg-primary-light">
                                <i class="bi bi-houses text-primary"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="fw-bold text-midnight mb-0">10,000+</h3>
                                <p class="text-muted small mb-0">Pilihan Kos</p>
                            </div>
                        </div>

                        <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="stat-icon bg-success-light">
                                <i class="bi bi-people text-success"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="fw-bold text-midnight mb-0">50,000+</h3>
                                <p class="text-muted small mb-0">Pengguna Aktif</p>
                            </div>
                        </div>

                        <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="stat-icon bg-warning-light">
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="fw-bold text-midnight mb-0">4.8/5</h3>
                                <p class="text-muted small mb-0">Rating Pengguna</p>
                            </div>
                        </div>

                        <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                            <div class="stat-icon bg-info-light">
                                <i class="bi bi-geo-alt-fill text-info"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="fw-bold text-midnight mb-0">100+</h3>
                                <p class="text-muted small mb-0">Kota di Indonesia</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial -->
                    <div class="testimonial-box" data-aos="fade-up" data-aos-delay="500">
                        <div class="testimonial-content">
                            <div class="quote-icon">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p class="testimonial-text">"Platform ini sangat membantu saya menemukan kos yang nyaman dan
                                sesuai budget. Prosesnya cepat dan mudah!"</p>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="author-info">
                                    <h6 class="fw-bold mb-0">Andi Pratama</h6>
                                    <small class="text-muted">Mahasiswa UI Jakarta</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Login Page Styles */
    .login-container {
        background: linear-gradient(135deg, var(--porcelain) 0%, var(--dawn) 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .login-card {
        background: white;
        padding: 3rem;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        animation: slideInLeft 0.6s ease-out;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--royal) 0%, var(--china) 100%);
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .login-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(51, 78, 172, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .login-icon i {
        font-size: 2rem;
        color: white;
    }

    .form-control-lg {
        border-radius: 12px;
        border: 2px solid var(--porcelain);
        padding: 0.875rem 1.25rem;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus {
        border-color: var(--royal);
        box-shadow: 0 0 0 0.25rem rgba(51, 78, 172, 0.15);
        transform: translateY(-2px);
    }

    .form-label {
        color: var(--midnight);
        margin-bottom: 0.5rem;
    }

    .forgot-link {
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .forgot-link:hover {
        color: var(--midnight) !important;
        text-decoration: underline !important;
    }

    .toggle-password {
        border-radius: 0 12px 12px 0;
        border-left: none;
    }

    .toggle-password:hover {
        background-color: var(--porcelain);
    }

    .form-check-input:checked {
        background-color: var(--royal);
        border-color: var(--royal);
    }

    .btn-login {
        background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
        border: none;
        border-radius: 12px;
        padding: 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 10px 25px rgba(51, 78, 172, 0.3);
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(51, 78, 172, 0.4);
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--porcelain);
    }

    .divider span {
        padding: 0 1rem;
        color: var(--china);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .btn-social {
        border-radius: 12px;
        padding: 0.75rem;
        font-weight: 600;
        border: 2px solid var(--porcelain);
        transition: all 0.3s ease;
    }

    .btn-social:hover {
        border-color: var(--royal);
        background-color: var(--dawn);
        transform: translateY(-2px);
    }

    /* Right Side Styles */
    .login-info {
        padding: 2rem;
        animation: slideInRight 0.6s ease-out;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .icon-wrapper {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(51, 78, 172, 0.3);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .icon-wrapper i {
        font-size: 3rem;
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon i {
        font-size: 1.5rem;
    }

    .stat-content h3 {
        font-size: 1.75rem;
        line-height: 1;
    }

    .testimonial-box {
        background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
        padding: 2rem;
        border-radius: 25px;
        box-shadow: 0 15px 40px rgba(51, 78, 172, 0.3);
    }

    .testimonial-content {
        color: white;
    }

    .quote-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .quote-icon i {
        font-size: 1.5rem;
    }

    .testimonial-text {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .author-avatar {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .author-avatar i {
        font-size: 2rem;
    }

    .author-info h6 {
        color: white;
    }

    .author-info small {
        color: rgba(255, 255, 255, 0.8);
    }

    .alert {
        border-radius: 12px;
        border: none;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bg-info-light {
        background-color: rgba(13, 202, 240, 0.1) !important;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .login-card {
            padding: 2rem 1.5rem;
        }

        .login-container {
            padding: 1rem 0;
        }
    }

    @media (max-width: 576px) {
        .login-card {
            padding: 1.5rem 1rem;
            border-radius: 20px;
        }

        .login-icon {
            width: 60px;
            height: 60px;
        }

        .login-icon i {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        .form-control-lg {
            padding: 0.75rem 1rem;
        }

        .btn-social {
            font-size: 0.875rem;
            padding: 0.625rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle Password Visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-fill');
                    icon.classList.add('bi-eye-slash-fill');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye-fill');
                }
            });
        });

        // Add focus animation
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function () {
                this.parentElement.classList.remove('focused');
            });
        });

        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });

</script>
@endsection
