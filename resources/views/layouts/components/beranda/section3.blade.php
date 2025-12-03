<style>
    .btn-detail,
    .btn-booking {
        flex: 1;
        text-align: center;
        padding: 0.7rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        /* jarak icon & tulisan */
    }

    .btn-detail i,
    .btn-booking i {
        font-size: 1rem;
    }

    /* Detail */
    .btn-detail {
        background: var(--porcelain);
        color: var(--midnight);
        border: 2px solid var(--royal);
    }

    .btn-detail:hover {
        background: var(--royal);
        color: white;
        transform: translateY(-2px);
    }

    /* Booking */
    .btn-booking {
        background: var(--royal);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(51, 78, 172, 0.3);
    }

    .btn-booking:hover {
        background: var(--midnight);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 31, 92, 0.4);
    }

</style>

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

                        <!-- Tombol Detail & Booking Dengan Icon -->
                        <div class="d-flex gap-2 mt-3">
                            <a href="" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>

                            <a href="" class="btn-booking">
                                <i class="fa-solid fa-calendar-check"></i> Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600" alt="Kos 2">
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

                        <!-- Tombol Detail & Booking Dengan Icon -->
                        <div class="d-flex gap-2 mt-3">
                            <a href="" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>

                            <a href="" class="btn-booking">
                                <i class="fa-solid fa-calendar-check"></i> Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600" alt="Kos 3">
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

                        <!-- Tombol Detail & Booking Dengan Icon -->
                        <div class="d-flex gap-2 mt-3">
                            <a href="" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>

                            <a href="" class="btn-booking">
                                <i class="fa-solid fa-calendar-check"></i> Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
