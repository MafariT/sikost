@extends('auth.layouts.main-layout-auth')

@section('content')
<div class="forgot-password-container">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-right">
                <div class="forgot-info">
                    <div class="illustration-wrapper">
                        <div class="icon-circle">
                            <i class="bi bi-key-fill"></i>
                        </div>
                        <div class="floating-icons">
                            <div class="float-icon icon-1"><i class="bi bi-shield-lock"></i></div>
                            <div class="float-icon icon-2"><i class="bi bi-envelope-check"></i></div>
                            <div class="float-icon icon-3"><i class="bi bi-arrow-clockwise"></i></div>
                        </div>
                    </div>

                    <h1 class="display-4 fw-bold text-midnight mb-3 mt-5">Jangan Khawatir!</h1>
                    <p class="lead text-muted mb-4">Kami siap membantu Anda mendapatkan kembali akses ke akun</p>

                    <div class="steps-container">
                        <h5 class="fw-bold text-midnight mb-3">Cara Reset Password:</h5>
                        <div class="step-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h6 class="fw-bold mb-1">Masukkan Email</h6>
                                <p class="text-muted small mb-0">Ketik email yang terdaftar di akun Anda</p>
                            </div>
                        </div>

                        <div class="step-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h6 class="fw-bold mb-1">Cek Email Anda</h6>
                                <p class="text-muted small mb-0">Kami akan mengirim link reset password</p>
                            </div>
                        </div>

                        <div class="step-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h6 class="fw-bold mb-1">Buat Password Baru</h6>
                                <p class="text-muted small mb-0">Klik link dan buat password baru yang aman</p>
                            </div>
                        </div>
                    </div>

                    <div class="security-note" data-aos="fade-up" data-aos-delay="400">
                        <div class="note-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="note-content">
                            <h6 class="fw-bold mb-1 text-success">Keamanan Terjamin</h6>
                            <p class="small text-muted mb-0">Link reset password hanya berlaku 60 menit dan hanya bisa digunakan sekali</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="col-lg-5 col-md-8" data-aos="fade-left">
                <div class="forgot-card">
                    <div class="text-center mb-4">
                        <div class="forgot-icon mb-3">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <h2 class="fw-bold text-midnight mb-2">Lupa Password?</h2>
                        <p class="text-muted">Masukkan email Anda dan kami akan mengirimkan link untuk reset password</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                                <div class="flex-grow-1">
                                    <strong>Email Terkirim!</strong>
                                    <p class="mb-0 mt-1 small">{{ session('status') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Oops!</strong> {{ $errors->first('email') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="forgot-form">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill me-2 text-primary"></i>Email Terdaftar
                            </label>
                            <div class="input-wrapper">
                                <input id="email"
                                       type="email"
                                       name="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="nama@email.com"
                                       required
                                       autofocus>
                                <div class="input-icon">
                                    <i class="bi bi-at"></i>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-reset">
                                <i class="bi bi-send-fill me-2"></i>Kirim Link Reset Password
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="divider">
                            <span>atau</span>
                        </div>

                        <!-- Action Links -->
                        <div class="action-links">
                            <div class="action-card">
                                <div class="action-icon bg-primary-light">
                                    <i class="bi bi-box-arrow-in-right text-primary"></i>
                                </div>
                                <div class="action-content">
                                    <h6 class="fw-bold mb-1">Sudah Punya Akun?</h6>
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm mt-1">
                                        <i class="bi bi-arrow-left me-2"></i>Login Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Forgot Password Page Styles */
.forgot-password-container {
    background: linear-gradient(135deg, var(--porcelain) 0%, var(--dawn) 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.forgot-card {
    background: white;
    padding: 3rem;
    border-radius: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
    animation: slideInRight 0.6s ease-out;
}

.forgot-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--royal) 0%, var(--china) 100%);
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

.forgot-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(51, 78, 172, 0.3);
    animation: shake 3s ease-in-out infinite;
}

@keyframes shake {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-5deg); }
    75% { transform: rotate(5deg); }
}

.forgot-icon i {
    font-size: 2rem;
    color: white;
}

.input-wrapper {
    position: relative;
}

.form-control-lg {
    border-radius: 12px;
    border: 2px solid var(--porcelain);
    padding: 0.875rem 3rem 0.875rem 1.25rem;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: var(--royal);
    box-shadow: 0 0 0 0.25rem rgba(51, 78, 172, 0.15);
    transform: translateY(-2px);
}

.input-icon {
    position: absolute;
    right: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--china);
    font-size: 1.25rem;
    pointer-events: none;
}

.form-control-lg:focus ~ .input-icon {
    color: var(--royal);
}

.btn-reset {
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    border: none;
    border-radius: 12px;
    padding: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 10px 25px rgba(51, 78, 172, 0.3);
    transition: all 0.3s ease;
}

.btn-reset:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(51, 78, 172, 0.4);
}

.divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 2rem 0;
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

.action-links {
    display: grid;
    gap: 1rem;
}

.action-card {
    background: var(--jicama);
    padding: 1.5rem;
    border-radius: 15px;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-card:hover {
    border-color: var(--royal);
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.action-icon i {
    font-size: 1.5rem;
}

.action-content h6 {
    color: var(--midnight);
}

.help-section {
    background: var(--dawn);
    padding: 1rem;
    border-radius: 12px;
    text-align: center;
}

.help-content {
    color: var(--midnight);
    font-size: 0.9rem;
}

/* Left Side Styles */
.forgot-info {
    padding: 2rem;
    animation: slideInLeft 0.6s ease-out;
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

.illustration-wrapper {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto 2rem;
}

.icon-circle {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 20px 50px rgba(51, 78, 172, 0.3);
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.icon-circle i {
    font-size: 5rem;
    color: white;
}

.floating-icons {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

.float-icon {
    position: absolute;
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.float-icon i {
    font-size: 1.5rem;
    color: var(--royal);
}

.icon-1 {
    top: -10px;
    right: 20px;
    animation: floatUpDown 3s ease-in-out infinite;
}

.icon-2 {
    bottom: 20px;
    left: -20px;
    animation: floatUpDown 3s ease-in-out infinite 1s;
}

.icon-3 {
    bottom: -10px;
    right: -10px;
    animation: floatUpDown 3s ease-in-out infinite 2s;
}

@keyframes floatUpDown {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.steps-container {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 2rem;
}

.step-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.step-item:last-child {
    margin-bottom: 0;
}

.step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.step-content h6 {
    color: var(--midnight);
}

.security-note {
    background: linear-gradient(135deg, rgba(37, 167, 69, 0.1) 0%, rgba(37, 167, 69, 0.05) 100%);
    padding: 1.5rem;
    border-radius: 15px;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    border-left: 4px solid #25a745;
}

.note-icon {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.note-icon i {
    font-size: 1.5rem;
    color: #25a745;
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
    .forgot-card {
        padding: 2rem 1.5rem;
    }

    .forgot-password-container {
        padding: 1rem 0;
    }
}

@media (max-width: 576px) {
    .forgot-card {
        padding: 1.5rem 1rem;
        border-radius: 20px;
    }

    .forgot-icon {
        width: 60px;
        height: 60px;
    }

    .forgot-icon i {
        font-size: 1.5rem;
    }

    h2 {
        font-size: 1.5rem;
    }

    .form-control-lg {
        padding: 0.75rem 2.5rem 0.75rem 1rem;
    }

    .action-card {
        flex-direction: column;
        text-align: center;
    }

    .action-icon {
        margin: 0 auto;
    }

    .illustration-wrapper {
        width: 150px;
        height: 150px;
    }

    .icon-circle {
        width: 150px;
        height: 150px;
    }

    .icon-circle i {
        font-size: 3.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add focus animation
    const emailInput = document.getElementById('email');

    if (emailInput) {
        emailInput.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        emailInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    }

    // Auto-dismiss alerts after 8 seconds (longer for success message)
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const isSuccess = alert.classList.contains('alert-success');
        const timeout = isSuccess ? 8000 : 5000;

        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, timeout);
    });

    // Form submission loading state
    const form = document.querySelector('.forgot-form');
    const submitBtn = form.querySelector('.btn-reset');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';
    });
});
</script>
@endsection
