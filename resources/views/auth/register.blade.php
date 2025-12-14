@extends('auth.layouts.main-layout-auth')

@section('content')
<div class="register-container">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <!-- Left Side - Illustration/Info -->
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-right">
                <div class="register-info">
                    <div class="icon-wrapper mb-4">
                        <i class="bi bi-house-heart-fill"></i>
                    </div>
                    <h1 class="display-4 fw-bold text-midnight mb-3">Temukan Kos Impianmu</h1>
                    <p class="lead text-muted mb-4">Bergabunglah dengan ribuan pencari kos yang sudah menemukan hunian nyaman mereka</p>

                    <div class="features-list">
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon bg-primary-light">
                                <i class="bi bi-search text-primary"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-bold mb-1">Pencarian Mudah</h5>
                                <p class="text-muted small mb-0">Temukan kos sesuai budget dan lokasi favoritmu</p>
                            </div>
                        </div>

                        <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-icon bg-success-light">
                                <i class="bi bi-shield-check text-success"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-bold mb-1">Terpercaya & Aman</h5>
                                <p class="text-muted small mb-0">Semua listing terverifikasi dan terjamin keamanannya</p>
                            </div>
                        </div>

                        <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-icon bg-warning-light">
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-bold mb-1">Kos Berkualitas</h5>
                                <p class="text-muted small mb-0">Pilihan kos dengan fasilitas terbaik dan harga terjangkau</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Registration Form -->
            <div class="col-lg-5 col-md-8" data-aos="fade-left">
                <div class="register-card">
                    <div class="text-center mb-4">
                        <div class="register-icon mb-3">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <h2 class="fw-bold text-midnight mb-2">Daftar Sekarang</h2>
                        <p class="text-muted">Mulai pencarian kos impianmu hari ini</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Oops!</strong> Ada kesalahan dalam pengisian form.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="register-form">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill me-2 text-primary"></i>Email
                            </label>
                            <div class="input-group">
                                <input id="email"
                                       type="email"
                                       name="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="nama@email.com"
                                       required
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock-fill me-2 text-primary"></i>Password
                            </label>
                            <div class="input-group">
                                <input id="password"
                                       type="password"
                                       name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       placeholder="Minimal 8 karakter"
                                       required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Gunakan kombinasi huruf, angka, dan simbol
                            </small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                <i class="bi bi-lock-fill me-2 text-primary"></i>Konfirmasi Password
                            </label>
                            <div class="input-group">
                                <input id="password_confirmation"
                                       type="password"
                                       name="password_confirmation"
                                       class="form-control form-control-lg"
                                       placeholder="Ulangi password"
                                       required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-register">
                                <i class="bi bi-person-check-fill me-2"></i>Daftar Sekarang
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                                    Login di sini <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Register Page Styles */
.register-container {
    background: linear-gradient(135deg, var(--porcelain) 0%, var(--dawn) 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.register-info .icon-wrapper {
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

.register-info .icon-wrapper i {
    font-size: 3rem;
    color: white;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.features-list {
    margin-top: 3rem;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateX(10px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.feature-icon i {
    font-size: 1.5rem;
}

.register-card {
    background: white;
    padding: 3rem;
    border-radius: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.register-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--royal) 0%, var(--china) 100%);
}

.register-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(51, 78, 172, 0.3);
}

.register-icon i {
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

.toggle-password {
    border-radius: 0 12px 12px 0;
    border-left: none;
}

.toggle-password:hover {
    background-color: var(--porcelain);
}

.btn-register {
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    border: none;
    border-radius: 12px;
    padding: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 10px 25px rgba(51, 78, 172, 0.3);
    transition: all 0.3s ease;
}

.btn-register:hover {
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

/* Responsive */
@media (max-width: 991px) {
    .register-card {
        padding: 2rem 1.5rem;
    }

    .register-container {
        padding: 1rem 0;
    }
}

@media (max-width: 576px) {
    .register-card {
        padding: 1.5rem 1rem;
        border-radius: 20px;
    }

    .register-icon {
        width: 60px;
        height: 60px;
    }

    .register-icon i {
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
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Password Visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
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

    // Form Validation Enhancement
    const form = document.querySelector('.register-form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    confirmPasswordInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value) {
            this.setCustomValidity('Password tidak cocok');
        } else {
            this.setCustomValidity('');
        }
    });

    // Add focus animation
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});
</script>
@endsection
