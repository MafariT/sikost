@extends('layouts.layoutPenyewa')

@section('title', 'Kamar - SiKos')

@section('konten')
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

    /* Styling Khusus Halaman Kamar */

    /* Container Utama */
    .kamar-page-section {
        padding: 5rem 0 6rem;
        background: var(--porcelain);
        /* Warna background yang netral dan estetik */
    }

    /* Header & Intro */
    .page-intro {
        text-align: center;
        margin-bottom: 3rem;
        padding: 4rem;
        background: var(--dawn);
        box-shadow: 0 4px 15px rgba(51, 78, 172, 0.1);
    }

    .page-intro h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--midnight);
        margin-bottom: 0.5rem;
    }

    .page-intro p {
        font-size: 1.1rem;
        color: var(--royal);
        max-width: 700px;
        margin: 0 auto;
    }

    /* Filter dan Search Box di Halaman Kamar */
    .filter-container {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 3rem;
    }

    .filter-container .form-control,
    .filter-container .form-select {
        border: 1px solid var(--porcelain);
        border-radius: 8px;
        padding: 0.7rem 1rem;
        transition: all 0.3s ease;
    }

    .filter-container .form-control:focus,
    .filter-container .form-select:focus {
        border-color: var(--royal);
        outline: none;
        box-shadow: 0 0 0 3px rgba(51, 78, 172, 0.1);
    }

    .filter-container .btn-filter {
        background: var(--royal);
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .filter-container .btn-filter:hover {
        background: var(--midnight);
    }

    /* Responsiveness untuk Filter */
    @media (max-width: 576px) {
        .filter-container .row>div {
            margin-bottom: 1rem;
        }

        .filter-container .btn-filter {
            width: 100%;
        }
    }

</style>

<section class="kamar-page-section">
    <div class="page-intro">
        <h1>Temukan Kamar Kos Impianmu</h1>
        <p>Jelajahi pilihan kamar kost terbaik dengan fasilitas lengkap.</p>
    </div>

    <div class="container">
        
        <div class="filter-container">
            <form action="{{ route('kamar.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-5 col-md-4 col-sm-12">
                        <label for="search" class="form-label fw-bold mb-1">Cari No Kamar / Info</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}"
                               placeholder="Contoh: A-101">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label for="ketersediaan" class="form-label fw-bold mb-1">Ketersediaan</label>
                        <select class="form-select" id="ketersediaan" name="ketersediaan">
                            <option value="">Semua Status</option>
                            <option value="available" {{ request('ketersediaan') == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="unavailable" {{ request('ketersediaan') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <label for="min_price" class="form-label fw-bold mb-1">Harga Min.</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" 
                               value="{{ request('min_price') }}"
                               placeholder="Rp">
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <button type="submit" class="btn-filter w-100">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row g-4">
            @forelse ($kamar as $item)
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="{{ Storage::disk('s3')->url($item->foto_kamar) }}" alt="Kamar {{ $item->no_kamar }}">

                        @if ($item->status == 'tersedia')
                        <span class="availability-badge badge-available">
                            <i class="fas fa-check-circle"></i> Tersedia
                        </span>
                        @else
                        <span class="availability-badge badge-unavailable">
                            <i class="fas fa-times-circle"></i> Penuh
                        </span>
                        @endif
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">Kamar {{ $item->no_kamar }}</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> SiKost Area Utama
                        </p>

                        <p class="text-muted small mb-2">
                            {{ Str::limit($item->deskripsi_kamar ?? 'Fasilitas lengkap, nyaman, dan aman.', 50) }}
                        </p>

                        <div class="kos-facilities">
                            <span class="facility-item"><i class="fas fa-snowflake"></i> AC</span>
                            <span class="facility-item"><i class="fas fa-wifi"></i> WiFi</span>
                        </div>

                        <div class="kos-price">
                            Rp {{ number_format($item->harga, 0, ',', '.') }} <span>/ tahun</span>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('kamar.show', $item->id_kamar) }}" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>

                            @if ($item->status == 'tersedia')
                                <a href="{{ route('booking.index') }}?kamar_id={{ $item->id_kamar }}" class="btn-booking">
                                    <i class="fa-solid fa-calendar-check"></i> Booking
                                </a>
                            @else
                                <button class="btn-booking bg-secondary border-secondary" disabled>
                                    <i class="fa-solid fa-calendar-times"></i> Penuh
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-warning">
                    <i class="fas fa-search mb-2 display-6 d-block"></i>
                    <h4>Tidak ada kamar ditemukan.</h4>
                    <p>Coba ubah filter pencarian Anda.</p>
                </div>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $kamar->links() }} 
        </div>

    </div>
</section>
@endsection
