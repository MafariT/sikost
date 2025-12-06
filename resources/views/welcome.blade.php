@extends('layouts.layout_utama')

@section('content')

<section class="position-relative d-flex align-items-center" style="min-height: 90vh; overflow: hidden;">
    <div class="blob-bg" style="top: -100px; right: -100px;"></div>
    
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge rounded-pill bg-light text-royal shadow-sm px-3 py-2 mb-3 border border-1">
                    <i class="bi bi-stars text-warning me-1"></i> Testing
                </span>
                <h1 class="display-3 fw-bold mb-4" style="color: var(--color-midnight); line-height: 1.2;">
                    Masa Depan Bisnis <br> 
                    <span class="text-gradient">Lebih Elegan.</span>
                </h1>
                <p class="lead mb-5 pe-lg-5" style="color: #666;">
                    Kami memadukan estetika desain dengan teknologi mutakhir. 
                    Bangun kehadiran digital Anda dengan palet warna yang menenangkan dan performa tanpa kompromi.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-royal-glow btn-lg px-5 rounded-pill fw-bold">Mulai Sekarang</a>
                    <a href="#" class="btn btn-outline-dark btn-lg px-4 rounded-pill border-0 shadow-sm" style="background-color: var(--color-moon);">
                        <i class="bi bi-play-circle me-2"></i> Demo
                    </a>
                </div>
            </div>

            <div class="col-lg-6 position-relative" data-aos="fade-left" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                     alt="Modern Office" 
                     class="img-fluid img-rounded-custom w-100 position-relative" 
                     style="z-index: 2;">
                
                <div class="card position-absolute shadow-lg border-0 p-3 rounded-4" 
                     style="bottom: -30px; left: -30px; z-index: 3; background-color: var(--color-jicama); width: 200px;"
                     data-aos="fade-up" data-aos-delay="400">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-2 d-flex justify-content-center align-items-center" style="background: var(--color-royal); width: 40px; height: 40px;">
                            <i class="bi bi-graph-up-arrow text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Pertumbuhan</small>
                            <span class="fw-bold text-midnight">+128%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="py-4" style="background-color: var(--color-porcelain);">
    <div class="container">
        <div class="row text-center align-items-center opacity-50 grayscale">
            <div class="col fw-bold h4 text-midnight mb-0">GOOGLE</div>
            <div class="col fw-bold h4 text-midnight mb-0">LARAVEL</div>
            <div class="col fw-bold h4 text-midnight mb-0">SPOTIFY</div>
            <div class="col fw-bold h4 text-midnight mb-0">AIRBNB</div>
            <div class="col fw-bold h4 text-midnight mb-0">STRIPE</div>
        </div>
    </div>
</div>

<section id="features" class="py-5" style="background-color: var(--color-asian-pear);">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-royal fw-bold text-uppercase letter-spacing-2">Keunggulan</h6>
            <h2 class="fw-bold display-5 text-midnight">Solusi Cerdas & Estetik</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 card-hover p-4" style="background-color: #fff; border-radius: 20px;">
                    <div class="mb-4 rounded-4 d-inline-flex align-items-center justify-content-center shadow-sm" 
                         style="width: 70px; height: 70px; background-color: var(--color-dawn);">
                        <i class="bi bi-palette fs-2" style="color: var(--color-royal);"></i>
                    </div>
                    <h4 class="fw-bold text-midnight">Desain Harmonis</h4>
                    <p class="text-muted">Menggunakan palet warna Asian Pear dan Moon yang menyejukkan mata pengguna.</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 card-hover p-4" style="background-color: #fff; border-radius: 20px;">
                    <div class="mb-4 rounded-4 d-inline-flex align-items-center justify-content-center shadow-sm" 
                         style="width: 70px; height: 70px; background-color: var(--color-sky);">
                        <i class="bi bi-shield-check fs-2 text-midnight"></i>
                    </div>
                    <h4 class="fw-bold text-midnight">Keamanan Royal</h4>
                    <p class="text-muted">Proteksi data tingkat tinggi sekuat benteng, menjamin privasi pengguna.</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 card-hover p-4" style="background-color: #fff; border-radius: 20px;">
                    <div class="mb-4 rounded-4 d-inline-flex align-items-center justify-content-center shadow-sm" 
                         style="width: 70px; height: 70px; background-color: var(--color-china);">
                        <i class="bi bi-lightning-charge fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-midnight">Performa Kilat</h4>
                    <p class="text-muted">Optimasi kode Laravel yang efisien memastikan website Anda secepat kilat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         class="img-fluid rounded-4 shadow-lg" alt="Showcase">
                    <div class="position-absolute" 
                         style="width: 100%; height: 100%; top: 20px; left: -20px; border: 2px solid var(--color-royal); border-radius: 20px; z-index: -1;"></div>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1 mt-4 mt-lg-0" data-aos="fade-right">
                <h2 class="display-6 fw-bold text-midnight mb-4">Analitik yang Mendalam</h2>
                <p class="lead text-secondary mb-4">
                    Pantau perkembangan bisnis Anda dengan dashboard yang intuitif. 
                    Warna <span style="color: var(--color-royal); font-weight:bold">Royal</span> memberikan penekanan pada data penting.
                </p>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="color: var(--color-china);"></i>
                        <span>Laporan Real-time</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="color: var(--color-china);"></i>
                        <span>Integrasi Mobile</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="color: var(--color-china);"></i>
                        <span>Export Data Mudah</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5 position-relative overflow-hidden text-center">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-midnight" style="z-index: -2;"></div>
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(135deg, rgba(51,78,172,0.5) 0%, rgba(8,31,92,0.9) 100%); z-index: -1;"></div>
    
    <div class="container py-5 position-relative" style="z-index: 1;" data-aos="zoom-in">
        <h2 class="display-5 fw-bold text-white mb-4">Siap Mengubah Bisnis Anda?</h2>
        <p class="lead text-white-50 mb-5 mx-auto" style="max-width: 600px;">
            Bergabunglah dengan ribuan pengguna lain yang telah merasakan kenyamanan desain kami.
        </p>
        <button class="btn btn-lg bg-asian-pear text-midnight fw-bold px-5 py-3 rounded-pill shadow-lg hover-scale">
            Daftar Sekarang Gratis
        </button>
    </div>
</section>

@endsection