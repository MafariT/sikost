@extends('auth.layouts.main-layout-auth')

@section('content')
<div class="reset-password-container">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <!-- Left Side - Security Info -->
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-right">
                <div class="reset-info">
                    <div class="illustration-wrapper">
                        <div class="shield-container">
                            <div class="shield-bg">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                            <div class="check-mark">
                                <i class="bi bi-check-lg"></i>
                            </div>
                        </div>
                        <div class="security-rings">
                            <div class="ring ring-1"></div>
                            <div class="ring ring-2"></div>
                            <div class="ring ring-3"></div>
                        </div>
                    </div>

                    <h1 class="display-4 fw-bold text-midnight mb-3 mt-5">Buat Password Baru</h1>
                    <p class="lead text-muted mb-4">Pastikan password baru Anda kuat dan aman untuk melindungi akun</p>

                    <div class="tips-container">
                        <h5 class="fw-bold text-midnight mb-3">
                            <i class="bi bi-lightbulb-fill text-warning me-2"></i>Tips Password Kuat:
                        </h5>

                        <div class="tip-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="tip-icon bg-primary-light">
                                <i class="bi bi-type text-primary"></i>
                            </div>
                            <div class="tip-content">
                                <h6 class="fw-bold mb-1">Minimal 8 Karakter</h6>
                                <p class="text-muted small mb-0">Gunakan kombinasi huruf besar, kecil, angka & simbol</p>
                            </div>
                        </div>

                        <div class="tip-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="tip-icon bg-success-light">
                                <i class="bi bi-ban text-success"></i>
                            </div>
                            <div class="tip-content">
                                <h6 class="fw-bold mb-1">Hindari Informasi Pribadi</h6>
                                <p class="text-muted small mb-0">Jangan gunakan nama, tanggal lahir, atau info mudah ditebak</p>
                            </div>
                        </div>

                        <div class="tip-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="tip-icon bg-warning-light">
                                <i class="bi bi-arrow-repeat text-warning"></i>
                            </div>
                            <div class="tip-content">
                                <h6 class="fw-bold mb-1">Password Unik</h6>
                                <p class="text-muted small mb-0">Gunakan password yang berbeda untuk setiap akun</p>
                            </div>
                        </div>
                    </div>

                    <div class="security-badge" data-aos="fade-up" data-aos-delay="400">
                        <div class="badge-content">
                            <i class="bi bi-shield-check fs-3 text-success"></i>
                            <div class="badge-text">
                                <h6 class="fw-bold mb-0 text-success">Enkripsi 256-bit</h6>
                                <small class="text-muted">Password Anda tersimpan dengan aman</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Reset Form -->
            <div class="col-lg-5 col-md-8" data-aos="fade-left">
                <div class="reset-card">
                    <div class="text-center mb-4">
                        <div class="reset-icon mb-3">
                            <i class="bi bi-key-fill"></i>
                        </div>
                        <h2 class="fw-bold text-midnight mb-2">Reset Password</h2>
                        <p class="text-muted">Buat password baru yang kuat dan mudah diingat</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="zoom-in">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Oops!</strong> Ada kesalahan dalam pengisian form.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form  class="reset-form">
                        <input type="hidden" name="token" value="">

                        <!-- Email Address (Read Only) -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill me-2 text-primary"></i>Email
                            </label>
                            <div class="input-wrapper">
                                <input id="email"
                                       type="email"
                                       name="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       value=""
                                       required
                                       readonly>
                                <div class="input-icon">
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Email tidak dapat diubah
                            </small>
                        </div>

                        <!-- New Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-key-fill me-2 text-primary"></i>Password Baru
                            </label>
                            <div class="input-wrapper">
                                <input id="password"
                                       type="password"
                                       name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       placeholder="Minimal 8 karakter"
                                       required>
                                <button class="password-toggle" type="button" data-target="password">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Strength Meter -->
                            <div class="password-strength mt-2">
                                <div class="strength-bar">
                                    <div class="strength-fill" id="strengthBar"></div>
                                </div>
                                <small class="strength-text text-muted" id="strengthText">Kekuatan password</small>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                <i class="bi bi-check-circle-fill me-2 text-primary"></i>Konfirmasi Password Baru
                            </label>
                            <div class="input-wrapper">
                                <input id="password_confirmation"
                                       type="password"
                                       name="password_confirmation"
                                       class="form-control form-control-lg"
                                       placeholder="Ketik ulang password baru"
                                       required>
                                <button class="password-toggle" type="button" data-target="password_confirmation">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Pastikan password sama dengan yang di atas
                            </small>
                        </div>

                        <!-- Password Requirements -->
                        <div class="requirements-box mb-4">
                            <h6 class="fw-bold mb-2 small">
                                <i class="bi bi-list-check me-2"></i>Password harus memenuhi:
                            </h6>
                            <ul class="requirements-list">
                                <li id="req-length" class="requirement">
                                    <i class="bi bi-circle"></i>
                                    <span>Minimal 8 karakter</span>
                                </li>
                                <li id="req-uppercase" class="requirement">
                                    <i class="bi bi-circle"></i>
                                    <span>Mengandung huruf besar (A-Z)</span>
                                </li>
                                <li id="req-lowercase" class="requirement">
                                    <i class="bi bi-circle"></i>
                                    <span>Mengandung huruf kecil (a-z)</span>
                                </li>
                                <li id="req-number" class="requirement">
                                    <i class="bi bi-circle"></i>
                                    <span>Mengandung angka (0-9)</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-reset">
                                <i class="bi bi-shield-check me-2"></i>Reset Password
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="divider">
                            <span>atau</span>
                        </div>

                        <!-- Action Links -->
                        <div class="action-links">
                            <a href="{{ route('login') }}" class="action-link link-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                <span>Kembali ke Login</span>
                                <i class="bi bi-arrow-right ms-auto"></i>
                            </a>

                            <a href="{{ route('register') }}" class="action-link link-success">
                                <i class="bi bi-person-plus me-2"></i>
                                <span>Belum punya akun? Daftar</span>
                                <i class="bi bi-arrow-right ms-auto"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Reset Password Page Styles */
.reset-password-container {
    background: linear-gradient(135deg, var(--porcelain) 0%, var(--dawn) 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.reset-card {
    background: white;
    padding: 3rem;
    border-radius: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
    animation: slideInRight 0.6s ease-out;
}

.reset-card::before {
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

.reset-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(51, 78, 172, 0.3);
    animation: bounce 2s ease-in-out infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.reset-icon i {
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

.form-control-lg[readonly] {
    background-color: var(--porcelain);
    cursor: not-allowed;
}

.input-icon {
    position: absolute;
    right: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--china);
    font-size: 1rem;
    pointer-events: none;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--china);
    font-size: 1.25rem;
    cursor: pointer;
    padding: 0.5rem;
    transition: all 0.3s ease;
}

.password-toggle:hover {
    color: var(--royal);
}

/* Password Strength Meter */
.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    height: 6px;
    background: var(--porcelain);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.strength-fill {
    height: 100%;
    width: 0;
    transition: all 0.3s ease;
    border-radius: 10px;
}

.strength-fill.weak {
    width: 33%;
    background: #dc3545;
}

.strength-fill.medium {
    width: 66%;
    background: #ffc107;
}

.strength-fill.strong {
    width: 100%;
    background: #25a745;
}

.strength-text {
    font-size: 0.85rem;
    display: block;
}

/* Password Requirements */
.requirements-box {
    background: var(--jicama);
    padding: 1rem 1.25rem;
    border-radius: 12px;
    border-left: 4px solid var(--royal);
}

.requirements-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.requirement {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0;
    font-size: 0.875rem;
    color: var(--midnight);
    transition: all 0.3s ease;
}

.requirement i {
    font-size: 0.75rem;
    color: var(--china);
}

.requirement.valid {
    color: #25a745;
}

.requirement.valid i {
    color: #25a745;
}

.requirement.valid i::before {
    content: "\f26b";
    font-family: 'bootstrap-icons';
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

.action-links {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.action-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 1.25rem;
    background: var(--jicama);
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-link.link-primary {
    color: var(--royal);
}

.action-link.link-success {
    color: #25a745;
}

.action-link:hover {
    border-color: currentColor;
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

/* Left Side Styles */
.reset-info {
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
    width: 250px;
    height: 250px;
    margin: 0 auto 2rem;
}

.shield-container {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
    z-index: 2;
}

.shield-bg {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, var(--royal) 0%, var(--china) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 20px 50px rgba(51, 78, 172, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.shield-bg i {
    font-size: 5rem;
    color: white;
}

.check-mark {
    position: absolute;
    bottom: -10px;
    right: -10px;
    width: 70px;
    height: 70px;
    background: #25a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(37, 167, 69, 0.3);
    animation: popIn 0.5s ease-out 0.5s both;
}

@keyframes popIn {
    0% { transform: scale(0); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

.check-mark i {
    font-size: 2rem;
    color: white;
    font-weight: bold;
}

.security-rings {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
}

.ring {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 2px solid var(--royal);
    border-radius: 50%;
    opacity: 0.3;
}

.ring-1 {
    width: 220px;
    height: 220px;
    animation: ripple 3s ease-out infinite;
}

.ring-2 {
    width: 240px;
    height: 240px;
    animation: ripple 3s ease-out 1s infinite;
}

.ring-3 {
    width: 260px;
    height: 260px;
    animation: ripple 3s ease-out 2s infinite;
}

@keyframes ripple {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0.5;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0;
    }
}

.tips-container {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 2rem;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.tip-item:last-child {
    margin-bottom: 0;
}

.tip-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.tip-icon i {
    font-size: 1.5rem;
}

.tip-content h6 {
    color: var(--midnight);
}

.security-badge {
    background: linear-gradient(135deg, rgba(37, 167, 69, 0.1) 0%, rgba(37, 167, 69, 0.05) 100%);
    padding: 1.5rem;
    border-radius: 15px;
    border-left: 4px solid #25a745;
}

.badge-content {
    display: flex;
    align-items: center;
    gap: 1rem;
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
    .reset-card {
        padding: 2rem 1.5rem;
    }
}

@media (max-width: 576px) {
    .reset-card {
        padding: 1.5rem 1rem;
        border-radius: 20px;
    }

    .reset-icon {
        width: 60px;
        height: 60px;
    }

    .reset-icon i {
        font-size: 1.5rem;
    }

    h2 {
        font-size: 1.5rem;
    }

    .form-control-lg {
        padding: 0.75rem 2.5rem 0.75rem 1rem;
    }

    .illustration-wrapper {
        width: 180px;
        height: 180px;
    }

    .shield-bg {
        width: 150px;
        height: 150px;
    }

    .shield-bg i {
        font-size: 3.5rem;
    }

    .check-mark {
        width: 50px;
        height: 50px;
    }

    .check-mark i {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');

    // Password Requirements
    const requirements = {
        length: document.getElementById('req-length'),
        uppercase: document.getElementById('req-uppercase'),
        lowercase: document.getElementById('req-lowercase'),
        number: document.getElementById('req-number')
    };

    // Toggle Password Visibility
    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
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

    // Password Strength Checker
    function checkPasswordStrength(password) {
        let strength = 0;

        // Check requirements
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);

        // Update requirement indicators
        requirements.length.classList.toggle('valid', hasLength);
        requirements.uppercase.classList.toggle('valid', hasUppercase);
        requirements.lowercase.classList.toggle('valid', hasLowercase);
        requirements.number.classList.toggle('valid', hasNumber);

        // Calculate strength
        if (hasLength) strength++;
        if (hasUppercase) strength++;
        if (hasLowercase) strength++;
        if (hasNumber) strength++;

        // Update strength bar
        strengthBar.classList.remove('weak', 'medium', 'strong');

        if (password.length === 0) {
            strengthBar.style.width = '0';
            strengthText.textContent = 'Kekuatan password';
            strengthText.className = 'strength-text text-muted';
        } else if (strength <= 2) {
            strengthBar.classList.add('weak');
            strengthText.textContent = 'Lemah';
            strengthText.className = 'strength-text text-danger';
        } else if (strength === 3) {
            strengthBar.classList.add('medium');
            strengthText.textContent = 'Sedang';
            strengthText.className = 'strength-text text-warning';
        } else {
            strengthBar.classList.add('strong');
            strengthText.textContent = 'Kuat';
            strengthText.className = 'strength-text text-success';
        }
    }

    // Password input event
    passwordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);
    });

    // Confirm password validation
    confirmInput.addEventListener('input', function() {
        if (this.value && this.value !== passwordInput.value) {
            this.setCustomValidity('Password tidak cocok');
        } else {
            this.setCustomValidity('');
        }
    });

    // Form submission
    const form = document.querySelector('.reset-form');
    const submitBtn = form.querySelector('.btn-reset');

    form.addEventListener('submit', function(e) {
        // Check if passwords match
        if (confirmInput.value !== passwordInput.value) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak cocok!');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
    });

    // Auto-dismiss alerts
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
