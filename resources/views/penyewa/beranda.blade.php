@extends('layouts.layoutPenyewa')

@section('title', 'KosKita - Temukan Kos Impianmu')

@section('konten')
<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1>Temukan Kos Impianmu dengan Mudah</h1>
                <p>Platform terpercaya untuk mahasiswa mencari hunian nyaman, aman, dan terjangkau di seluruh Indonesia
                </p>

                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari lokasi kos...">
                    <select class="form-select">
                        <option>Semua Tipe</option>
                        <option>Kos Putra</option>
                        <option>Kos Putri</option>
                        <option>Kos Campur</option>
                    </select>
                    <button class="btn btn-search">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800" alt="Hero Image">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section" id="features">
    <div class="container">
        <div class="section-title">
            <h2>Kenapa Pilih KosKita?</h2>
            <p>Kemudahan dan kenyamanan dalam satu platform</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Semua kos terverifikasi dan dijamin keamanannya</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search-location"></i>
                    </div>
                    <h3>Mudah Dicari</h3>
                    <p>Temukan kos dengan filter lokasi dan fasilitas</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3>Harga Terjangkau</h3>
                    <p>Berbagai pilihan kos sesuai budget mahasiswa</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Support 24/7</h3>
                    <p>Tim kami siap membantu kapan saja</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Kos Section -->
<section class="kos-section" id="kos">
    <div class="container">
        <div class="section-title">
            <h2>Kos Paling Populer</h2>
            <p>Pilihan favorit mahasiswa di berbagai kota</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600" alt="Kos 1">
                        <span class="kos-badge">Populer</span>
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">Kos Melati Residence</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> Yogyakarta
                        </p>
                        <div class="kos-facilities">
                            <span class="facility-item">
                                <i class="fas fa-wifi"></i> WiFi
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-snowflake"></i> AC
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-utensils"></i> Dapur
                            </span>
                        </div>
                        <div class="kos-price">
                            Rp 1.2jt <span>/ bulan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600" alt="Kos 2">
                        <span class="kos-badge">Rekomendasi</span>
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">Kos Mawar Indah</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> Bandung
                        </p>
                        <div class="kos-facilities">
                            <span class="facility-item">
                                <i class="fas fa-wifi"></i> WiFi
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-parking"></i> Parkir
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-tv"></i> TV
                            </span>
                        </div>
                        <div class="kos-price">
                            Rp 950rb <span>/ bulan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600" alt="Kos 3">
                        <span class="kos-badge">Baru</span>
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">Kos Anggrek Premium</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> Surabaya
                        </p>
                        <div class="kos-facilities">
                            <span class="facility-item">
                                <i class="fas fa-wifi"></i> WiFi
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-swimming-pool"></i> Kolam
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-dumbbell"></i> Gym
                            </span>
                        </div>
                        <div class="kos-price">
                            Rp 1.5jt <span>/ bulan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Siap Temukan Kos Impianmu?</h2>
        <p>Bergabunglah dengan ribuan mahasiswa yang sudah menemukan hunian nyaman mereka</p>
        <button class="btn btn-light-custom">Mulai Sekarang <i class="fas fa-arrow-right ms-2"></i></button>
    </div>
</section>
@endsection
