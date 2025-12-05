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

{{-- Data Dummy untuk Contoh (Simulasikan data dari Controller) --}}
@php
$kos_list = [
[
'nama' => 'Kos Cendana Elite',
'lokasi' => 'Sleman, Yogyakarta',
'harga' => '1.8jt',
'available' => true,
'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600',
],
[
'nama' => 'Pondok Hijau Syariah',
'lokasi' => 'Depok, Sleman',
'harga' => '950rb',
'available' => false,
'image' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600',
],
[
'nama' => 'Griya Utama Putra',
'lokasi' => 'Seturan, Yogyakarta',
'harga' => '1.1jt',
'available' => true,
'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600',
],
[
'nama' => 'The Cozy Inn',
'lokasi' => 'Jakal KM 5',
'harga' => '1.4jt',
'available' => true,
'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600',
],
[
'nama' => 'Maharani Kost Putri',
'lokasi' => 'Kota Gede',
'harga' => '800rb',
'available' => false,
'image' => 'https://images.unsplash.com/photo-1513584684374-8bab748fbf90?q=80&w=1500',
],
];
@endphp

<section class="kamar-page-section">
    {{-- Bagian Intro Halaman --}}
    <div class="page-intro">
        <h1>Temukan Kamar Kos Impianmu</h1>
        <p>Jelajahi ribuan pilihan kamar kost terbaik, lengkap dengan fasilitas yang kamu butuhkan. Mulai dari AC
            hingga kamar mandi dalam, semua ada di sini!</p>
    </div>
    <div class="container">
        {{-- Filter dan Search Section --}}
        <div class="filter-container">
            <form action="#" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-5 col-md-4 col-sm-12">
                        <label for="search" class="form-label fw-bold mb-1">Cari Nama Kos / Area</label>
                        <input type="text" class="form-control" id="search" name="search"
                            placeholder="Contoh: Kos Melati, Sleman">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label for="ketersediaan" class="form-label fw-bold mb-1">Ketersediaan</label>
                        <select class="form-select" id="ketersediaan" name="ketersediaan">
                            <option value="">Semua Status</option>
                            <option value="available">Tersedia</option>
                            <option value="unavailable">Tidak Tersedia</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <label for="min_price" class="form-label fw-bold mb-1">Harga Min.</label>
                        <input type="number" class="form-control" id="min_price" name="min_price"
                            placeholder="Contoh: 800000">
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <button type="submit" class="btn-filter w-100">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Daftar Kos (Menggunakan Struktur Card yang Sudah Diperbaiki) --}}
        <div class="row g-4">
            {{-- Loop data kos dummy --}}
            @foreach ($kos_list as $kos)
            <div class="col-lg-4 col-md-6">
                <div class="kos-card">
                    <div class="kos-image">
                        <img src="{{ $kos['image'] }}" alt="{{ $kos['nama'] }}">

                        {{-- Badge Ketersediaan --}}
                        @if ($kos['available'])
                        <span class="availability-badge badge-available">
                            <i class="fas fa-check-circle"></i> Tersedia
                        </span>
                        @else
                        <span class="availability-badge badge-unavailable">
                            <i class="fas fa-times-circle"></i> Tidak Tersedia
                        </span>
                        @endif
                    </div>
                    <div class="kos-content">
                        <h3 class="kos-title">{{ $kos['nama'] }}</h3>
                        <p class="kos-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $kos['lokasi'] }}
                        </p>

                        {{-- Fasilitas yang Dibatasi --}}
                        <div class="kos-facilities">
                            <span class="facility-item"><i class="fas fa-snowflake"></i> AC</span>
                            <span class="facility-item"><i class="fas fa-shower"></i> KM Dalam</span>
                            <span class="facility-item"><i class="fas fa-wifi"></i> WiFi</span>
                            <span class="facility-item"><i class="fas fa-utensils"></i> Dapur</span>
                        </div>

                        <div class="kos-price">
                            Rp {{ $kos['harga'] }} <span>/ bulan</span>
                        </div>

                        {{-- Tombol Detail & Booking --}}
                        <div class="d-flex gap-2 mt-3">
                            <a href="/kamar/1" class="btn-detail">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>
                            @if ($kos['available'])
                            <a href="#" class="btn-booking">
                                <i class="fa-solid fa-calendar-check"></i> Booking
                            </a>
                            @else
                            {{-- Jika tidak tersedia, tombol booking dinonaktifkan/berbeda --}}
                            <button class="btn-booking bg-secondary border-secondary" disabled>
                                <i class="fa-solid fa-calendar-times"></i> Penuh
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Contoh Pagination (Optional) --}}
        <div class="d-flex justify-content-center mt-5">
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>

    </div>
</section>
@endsection
