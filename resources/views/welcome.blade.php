@extends('layouts.layout_utama')

@section('content')

{{-- Style Tambahan Khusus untuk Halaman Ini --}}
<style>
    /* Mengambil warna dari kode SIKOST pertama, disesuaikan dengan variabel CSS di layout_utama */
    .navbar-sikost {
        background: var(--color-midnight, #081F5C); /* Midnight/Biru Tua */
        padding: 18px 40px;
        color: white;
    }
    .btn-sikost-primary {
        background: var(--color-royal, #334EAC); /* Royal/Biru Sedang */
        color: white;
        padding: 15px 35px;
        border-radius: 8px;
        font-size: 19px;
        text-decoration: none;
        transition: .3s;
        border: none;
    }
    .btn-sikost-primary:hover {
        background: var(--color-midnight, #081F5C);
        color: white;
    }
    .hero-sikost-bg {
        /* Menggunakan warna background dan opacity dari kode SIKOST pertama */
        background: rgba(237, 241, 246, 0.95); /* Light Grey-Blue Transparan */
    }
    .features-sikost-bg {
        /* Menggunakan warna background dan opacity dari kode SIKOST pertama */
        background: rgba(208, 227, 255, 0.9); /* Pale Blue Transparan */
        padding: 90px 20px;
    }
    .feature-item-sikost {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        color: var(--color-royal, #334EAC);
        font-weight: 500;
        text-align: center;
        flex: 1 1 260px; /* Fleksibilitas ukuran item */
    }
    .footer-sikost {
        background: var(--color-midnight, #081F5C);
        color: var(--color-sky, #BAD6EB); /* Sky/Biru Muda untuk teks */
    }
</style>



{{-- Bagian Hero (Menggabungkan desain SIKOST dan struktur Bootstrap) --}}
<section class="hero-sikost-bg position-relative d-flex align-items-center" style="min-height: 90vh;">
    {{-- Ini bisa jadi bagian untuk background image yang Anda sebutkan di CSS SIKOST pertama --}}
    {{-- <div class="w-100 h-100 position-absolute" style="background-image: url('{{ asset("img/apartemen.jpg") }}'); background-size: cover; z-index: -1;"></div> --}}

    <div class="container py-5 text-center">
        <h1 class="display-3 fw-bold mb-4" style="color: var(--color-midnight, #081F5C);">
            Selamat Datang di SIKOST!
        </h1>
        <p class="lead mb-5" style="font-size: 24px; color: var(--color-royal, #334EAC);">
            Sistem Penyewaan Kamar Kost Secara Online
        </p>
        <a href="#" class="btn-sikost-primary">Mulai Cari Kamar</a>
    </div>
</section>

{{-- Bagian Fitur (Menggunakan gaya SIKOST dan layout Bootstrap) --}}
<section class="features-sikost-bg">
    <div class="container">
        <h2 class="fw-bold display-5 mb-5 text-center" style="color: var(--color-midnight, #081F5C);">Mengapa SIKOST?</h2>
        <div class="feature-box d-flex flex-wrap justify-content-center gap-4 mx-auto" style="max-width: 900px;">
            <div class="feature-item-sikost">Booking Kamar Kapan Pun</div>
            <div class="feature-item-sikost">Aman dan Nyaman</div>
            <div class="feature-item-sikost">Harga lengkap & transparan</div>
            <div class="feature-item-sikost">Check-in & Check-Out dimana saja</div>
        </div>
    </div>
</section>

{{-- Footer (Menggunakan gaya SIKOST) --}}
<footer class="footer-sikost text-center py-4">
    <p class="mb-0">© 2025 SIKOST — Platform Penyewaan Kos Online</p>
</footer>

@endsection