<style>
    /* Badge Ketersediaan Baru */
    .availability-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        /* Pindah ke kiri atas */
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        color: white;
        z-index: 10;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .badge-available {
        background: #28a745;
        /* Hijau */
    }

    .badge-unavailable {
        background: #dc3545;
        /* Merah */
    }

    /* Tombol Detail & Booking Baru */
    .btn-detail,
    .btn-booking {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.7rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.95rem;
        flex-grow: 1;
        /* Agar tombol mengisi ruang yang tersedia */
    }

    .btn-detail {
        background: var(--china);
        color: white;
        border: 2px solid var(--china);
    }

    .btn-detail:hover {
        background: var(--royal);
        color: white;
        border-color: var(--royal);
        transform: translateY(-1px);
    }

    .btn-booking {
        background: var(--royal);
        color: white;
        border: 2px solid var(--royal);
        box-shadow: 0 4px 15px rgba(51, 78, 172, 0.2);
    }

    .btn-booking:hover {
        background: var(--midnight);
        border-color: var(--midnight);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(8, 31, 92, 0.3);
    }

</style>

<section class="kos-section" id="kos">
    <div class="container">
        <div class="section-title">
            <h2>Kos Paling Populer</h2>
            <p>Pilihan favorit mahasiswa di berbagai kota</p>
        </div>
        
        {{-- Baris utama untuk menampung semua card --}}
        <div class="row g-4"> 
            
            {{-- CARD 1: Kos Melati Residence (Gambar 1) --}}
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600" alt="Kos 1">
                        
                        {{-- Badge Ketersediaan Baru --}}
                        <span class="availability-badge badge-available">
                            <i class="fas fa-check-circle"></i> Tersedia
                        </span>
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">Kos Melati Residence</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> Yogyakarta
                        </p>

                        {{-- Fasilitas yang Dibatasi --}}
                        <div class="kos-facilities">
                            <span class="facility-item">
                                <i class="fas fa-snowflake"></i> AC
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-shower"></i> KM Dalam
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-wifi"></i> WiFi
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-utensils"></i> Dapur
                            </span>
                        </div>

                        <div class="kos-price">
                            Rp 1.2jt <span>/ bulan</span>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="#" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>
                            <a href="#" class="btn-booking">
                                <i class="fa-solid fa-calendar-check"></i> Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- CARD 2: Kos Melati Residence (Gambar 2) --}}
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    {{-- Di sini ada duplikasi, saya hapus <div class="kos-card"> yang berlebihan --}}
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600" alt="Kos 2">

                        {{-- Badge Ketersediaan Baru (Contoh: Tidak Tersedia) --}}
                        <span class="availability-badge badge-unavailable">
                            <i class="fas fa-times-circle"></i> Tidak Tersedia
                        </span>
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">Kos Anggrek Mewah</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> Sleman, Yogyakarta
                        </p>

                        {{-- Fasilitas yang Dibatasi --}}
                        <div class="kos-facilities">
                            <span class="facility-item">
                                <i class="fas fa-snowflake"></i> AC
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-shower"></i> KM Dalam
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-wifi"></i> WiFi
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-utensils"></i> Dapur
                            </span>
                        </div>

                        <div class="kos-price">
                            Rp 1.5jt <span>/ bulan</span>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="#" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>
                            <a href="#" class="btn-booking">
                                <i class="fa-solid fa-calendar-check"></i> Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- CARD 3: Kos Melati Residence (Gambar 3) --}}
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    {{-- Di sini ada duplikasi, saya hapus <div class="kos-card"> yang berlebihan --}}
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600" alt="Kos 3">

                        {{-- Badge Ketersediaan Baru --}}
                        <span class="availability-badge badge-available">
                            <i class="fas fa-check-circle"></i> Tersedia
                        </span>
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">Kos Bunga Indah</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> Bantul, Yogyakarta
                        </p>

                        {{-- Fasilitas yang Dibatasi --}}
                        <div class="kos-facilities">
                            <span class="facility-item">
                                <i class="fas fa-snowflake"></i> AC
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-shower"></i> KM Dalam
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-wifi"></i> WiFi
                            </span>
                            <span class="facility-item">
                                <i class="fas fa-utensils"></i> Dapur
                            </span>
                        </div>

                        <div class="kos-price">
                            Rp 1.0jt <span>/ bulan</span>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="#" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>
                            <a href="#" class="btn-booking">
                                <i class="fa-solid fa-calendar-check"></i> Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        {{-- Akhir dari row --}}
    </div>
</section>
