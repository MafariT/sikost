@extends('layouts.layout_utama')

@section('content')

{{-- Style Tambahan Khusus untuk Halaman Ini --}}
<style>
    /* Mengambil dan menyesuaikan warna dasar SIKOST */
    :root {
        --color-midnight: #081F5C; /* Biru Tua */
        --color-royal: #334EAC; /* Biru Sedang */
        --color-sky: #BAD6EB; /* Biru Muda */
        --color-dawn: #EDF1F6; /* Abu-abu Biru Sangat Muda */
        --color-asian-pear: #E4EBEB; /* Hijau Pucat/Netral */
    }
    
    /* === STICKY FOOTER CSS START === */
    html {
    scroll-behavior: smooth;
}

    html, body {
        height: 100%; /* Penting: Memastikan tinggi HTML dan Body 100% dari viewport */
        margin: 0;
        padding: 0;
    }
    body {
        display: flex;
        flex-direction: column; /* Mengatur konten berurutan secara vertikal */
    }
    main {
        flex-grow: 1; /* Penting: Memastikan konten utama mengambil semua ruang sisa yang tersedia */
    }
    /* === STICKY FOOTER CSS END === */


    /* Style Navigasi di dalam Hero Area */
    .navbar-sikost-light {
        background: transparent;
        color: white;
        /* Padding horizontal tetap, padding vertikal diatur di sini */
        padding: 15px 0;
        z-index: 100;
    }

    /* Primary Button: Royal Blue */
    .btn-sikost-primary {
        background: var(--color-royal);
        color: white;
        /* Ukuran untuk CTA Hero (tetap besar) */
        padding: 15px 40px; 
        border-radius: 8px;
        font-size: 1.25rem;
        font-weight: 600;
        transition: .3s;
        border: none;
        line-height: 1; /* Memastikan tinggi baris konsisten */
    }
    .btn-sikost-primary:hover {
        background: var(--color-midnight);
        color: white;
    }
    
    /* Style Khusus untuk Tombol Login di Navigasi */
    .btn-nav-login {
        /* Mengoverride padding dan font-size agar lebih kecil */
        padding: 8px 18px !important; 
        font-size: 0.95rem !important;
        border-radius: 50px !important; /* Membuat lebih bulat */
        align-self: center; /* Memastikan sejajar vertikal dengan teks menu */
    }

    /* Secondary/Outline Button */
    .btn-sikost-secondary {
        background: white;
        color: var(--color-royal);
        border: 1px solid var(--color-royal);
        padding: 10px 30px;
        border-radius: 6px;
        font-weight: 600;
        transition: .3s;
    }
    .btn-sikost-secondary:hover {
        background: var(--color-royal);
        color: white;
    }

    /* Card Style */
    .card-sikost-feature {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s;
    }
    .card-sikost-feature:hover {
        transform: translateY(-5px);
    }

    /* Warna Background */
    .bg-sikost-light {
        background: var(--color-dawn);
    }
    .bg-sikost-pale {
        background: var(--color-asian-pear);
    }

    /* Footer CTA Background */
    .cta-footer-sikost {
        background: var(--color-royal);
    }

    /* FAQ specific styles */
    .faq-item {
        border-bottom: 1px solid var(--color-sky);
        padding: 15px 0;
    }
    .faq-item:last-child {
        border-bottom: none;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }
    .accordion-button:not(.collapsed) {
        color: var(--color-midnight);
        background-color: transparent;
        font-weight: bold;
    }
    /* Footer Full-Width Style (Dipertahankan) */
    .footer {
    background: linear-gradient(135deg, #081F5C 0%, #0a2466 100%);
    color: #fff;
    padding: 3rem 0 1.5rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-section h5 {
    color: #D0E3FF;
    font-weight: 700;
    margin-bottom: 1rem;
}

.footer-section p,
.footer-section a {
    color: rgba(255,255,255,.8);
    font-size: .9rem;
    line-height: 1.7;
    text-decoration: none;
    transition: .3s;
}

.footer-section a:hover {
    color: #D0E3FF;
    padding-left: 5px;
}

.footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-section ul li {
    margin-bottom: .5rem;
}

/* =========================
   SOCIAL ICON
========================= */
.footer-social {
    display: flex;
    gap: .75rem;
    margin-top: 1rem;
}

.footer-social a {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-social a:hover {
    background: #334EAC;
    transform: translateY(-3px);
}

/* =========================
   FOOTER BOTTOM
========================= */
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,.1);
    padding-top: 1.5rem;
    text-align: center;
}

.footer-bottom p {
    margin: 0;
    font-size: .85rem;
    opacity: .7;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
    .footer-content {
        text-align: center;
    }
    .footer-social {
        justify-content: center;
    }
}
</style>

{{-- BUNGKUS SELURUH KONTEN UTAMA DENGAN TAG <MAIN> --}}
<main> 

    {{-- 1. HEADER/HERO AREA --}}
  <section id="beranda" class="position-relative overflow-hidden" style="min-height: 80vh;">
        {{-- Background Image --}}
        <div class="position-absolute w-100 h-100" 
            style="background-image: url('{{ asset('img/apartemen.jpeg') }}'); 
                    background-size: cover; 
                    background-position: center; 
                    filter: brightness(0.8); z-index: -1;">
        </div>
        
        {{-- Navigasi (DIKOREKSI) --}}
        <div class="container navbar-sikost-light position-absolute top-0 start-50 translate-middle-x">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo h4 mb-0 text-white fw-bold">SIKOST</div>
                <div class="menu d-none d-md-flex gap-4 align-items-center">
                   <a href="#beranda" class="text-white text-decoration-none fw-normal">Beranda</a>
                    <a href="#tentang" class="text-white text-decoration-none fw-normal">Tentang</a>

                    {{-- TOMBOL LOGIN KECIL DAN SEJAJAR --}}
                  <a href="{{ route('login') }}" class="btn btn-sikost-primary btn-nav-login">Login</a>
                </div>
            </div>
        </div>

        {{-- Content Hero Tengah --}}
        <div class="container d-flex flex-column justify-content-center align-items-center text-center text-white" style="min-height: 80vh;">
            <h1 class="display-3 fw-bold mb-3" style="line-height: 1.2;">
                Pesan Kamar Kos, <br> Lebih Mudah, Lebih Aman
            </h1>
            <p class="lead mb-5 fw-light mx-auto" style="max-width: 600px;">
                Jelajahi berbagai pilihan kamar kos yang aman, nyaman, dan transparan harganya.
            </p>
            
            {{-- Tombol "Cari Kamar" Besar --}}
            <a href="{{ route('login') }}" class="btn btn-sikost-primary shadow-lg">
          Login
            </a>
        </div>
    </section>

    {{-- 2. EXPERT GUIDES (PANDUAN) --}}
    <section class="py-5 bg-white">
        <div class="container py-5">
            <h2 class="text-center fw-bold text-midnight mb-5">
                Panduan Ahli untuk Mencari Kost Sempurna
            </h2>
            <div class="row g-4 text-center">
                {{-- Panduan 1: Sewa Kost --}}
                <div class="col-md-4">
                    <div class="p-4 card-sikost-feature h-100">
                        <i class="bi bi-key-fill display-4 mb-3" style="color: var(--color-royal);"></i>
                        <h4 class="fw-bold text-midnight">Sewa Kamar Kost</h4>
                        <p class="text-muted">Temukan kamar kost bulanan atau tahunan dengan fasilitas lengkap sesuai kebutuhan Anda.</p>
                        <a href="#" class="text-royal text-decoration-none fw-bold small">Mulai Sewa Kost <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                {{-- Panduan 2: Titip Kelola --}}
                <div class="col-md-4">
                    <div class="p-4 card-sikost-feature h-100">
                        <i class="bi bi-building-fill-check display-4 mb-3" style="color: var(--color-royal);"></i>
                        <h4 class="fw-bold text-midnight">Titip Kelola Properti</h4>
                        <p class="text-muted">Anda pemilik kos? Percayakan pengelolaan properti Anda pada tim profesional SIKOST.</p>
                        <a href="#" class="text-royal text-decoration-none fw-bold small">Daftar Properti Anda <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                {{-- Panduan 3: Pembayaran Praktis --}}
                <div class="col-md-4">
                    <div class="p-4 card-sikost-feature h-100">
                        <i class="bi bi-credit-card-2-front-fill display-4 mb-3" style="color: var(--color-royal);"></i>
                        <h4 class="fw-bold text-midnight">Pembayaran Praktis</h4>
                        <p class="text-muted">Lakukan pembayaran sewa secara aman dan transparan melalui berbagai metode yang tersedia.</p>
                        <a href="#" class="text-royal text-decoration-none fw-bold small">Lihat Metode Pembayaran <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. GENERAL FAQS --}}
    <section id="faq" class="py-5 bg-sikost-light">
        <div class="container py-5">
            <div class="row align-items-center">
                
                {{-- Bagian Kiri: Gambar --}}
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ asset('img/properti-kos.jpg') }}" class="img-fluid rounded-3 shadow-lg" alt="Foto Properti Kos SIKOST">
                </div>

                {{-- Bagian Kanan: FAQs Accordion --}}
                <div class="col-lg-7">
                    <h2 class="fw-bold text-midnight mb-4">FAQs Umum</h2>
                    
                    <div class="accordion accordion-flush" id="faqAccordion">
                        
                        {{-- FAQ Item 1 --}}
                        <div class="faq-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="false" aria-controls="faqCollapseOne">
                                    Apakah SIKOST menyediakan layanan setelah sewa?
                                </button>
                            </h3>
                            <div id="faqCollapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Kami menyediakan dukungan pelanggan selama masa sewa untuk membantu menyelesaikan masalah yang mungkin timbul, seperti kerusakan minor atau koordinasi pembayaran.
                                </div>
                            </div>
                        </div>

                        {{-- FAQ Item 2 --}}
                        <div class="faq-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                    Bagaimana proses pembayaran di SIKOST?
                                </button>
                            </h3>
                            <div id="faqCollapseTwo" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Ya, kami bekerja sama dengan mitra terpercaya untuk menyediakan berbagai opsi pembayaran digital yang aman, termasuk transfer bank, e-wallet, dan kartu kredit. Proses pembayaran dilakukan sepenuhnya secara online.
                                </div>
                            </div>
                        </div>

                        {{-- FAQ Item 3 --}}
                        <div class="faq-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                    Berapa lama proses booking dan check-in?
                                </button>
                            </h3>
                            <div id="faqCollapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Proses booking bisa selesai dalam hitungan menit setelah Anda memilih kamar dan menyelesaikan pembayaran. Check-in dapat dilakukan sesuai perjanjian, biasanya pada tanggal mulai sewa.
                                </div>
                            </div>
                        </div>

                        {{-- FAQ Item 4 --}}
                        <div class="faq-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                    Bagaimana cara menjadwalkan kunjungan ke properti?
                                </button>
                            </h3>
                            <div id="faqCollapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Anda dapat menggunakan fitur "Jadwalkan Kunjungan" di halaman detail kamar. Tim kami akan menghubungi Anda untuk mengkonfirmasi waktu kunjungan dengan pemilik properti.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- 4. TESTIMONIALS (ULASAN PENGGUNA) --}}
    <section class="py-5 bg-sikost-pale">
        <div class="container py-5">
            <h2 class="text-center fw-bold text-midnight mb-2">Apa Kata Penyewa Kami?</h2>
            <p class="text-center lead text-muted mb-5">Dengarkan pengalaman nyata dari SIKOST.</p>

            <div class="row g-4 justify-content-center">
                {{-- Testi 1 --}}
                <div class="col-md-4">
                    <div class="card p-4 h-100 border-0 card-sikost-feature">
                        <p class="fst-italic text-midnight mb-4">"Saya menemukan kamar kos dalam waktu kurang dari 24 jam! Proses booking sangat cepat dan tim SIKOST sangat responsif."</p>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/avatar-sarah.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px;" alt="Ulasan Sarah Wulan">
                            <div>
                                <span class="d-block fw-bold text-midnight">Sarah Wulan</span>
                                <small class="text-muted">Mahasiswi, UNJA</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testi 2 --}}
                <div class="col-md-4">
                    <div class="card p-4 h-100 border-0 card-sikost-feature">
                        <p class="fst-italic text-midnight mb-4">"Harga transparan dan tidak ada biaya tersembunyi. Foto kamar yang ditampilkan juga 100% akurat. Pengalaman terbaik mencari kos online!"</p>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/avatar-bima.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px;" alt="Ulasan Bima Ardiansyah">
                            <div>
                                <span class="d-block fw-bold text-midnight">Bima Ardiansyah</span>
                                <small class="text-muted">Mahasiswa, UIN</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. FIND YOUR DREAM HOME FOOTER CTA --}}
    <section class="py-5 cta-footer-sikost text-white">
        <div class="container py-5 text-center">
            <h2 class="display-4 fw-bold mb-3">Temukan Kamar Kos Impian Anda!</h2>
            <p class="lead mb-4 mx-auto" style="max-width: 600px;">
                Kami menciptakan dunia kenyamanan, keamanan, dan kepastian harga. Mulai pencarian Anda hari ini.
            </p>
            <a href="#" class="btn btn-sikost-secondary btn-lg rounded-pill px-5 py-3">
                Mulai Cari Kamar
            </a>
        </div>
    </section>

</main> 
{{-- AKHIR TAG </MAIN> --}}

{{-- Footer SIKOST --}}
<footer id="tentang" class="footer">

    <div class="container">
        <div class="footer-content">

            {{-- About --}}
            <div class="footer-section">
                <img src="{{ asset('img/logo_admin.png') }}" alt="Logo" style="height:40px" class="mb-3">
                <p>Platform terpercaya untuk mencari dan menyewakan kos dengan mudah, aman, dan nyaman.</p>
                <div class="footer-social">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            {{-- Link Cepat --}}
            <div class="footer-section">
                <h5>Link Cepat</h5>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Cari Kamar</a></li>
                    <li><a href="#">Titip Kelola</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                </ul>
            </div>

            {{-- Bantuan --}}
            <div class="footer-section">
                <h5>Bantuan</h5>
                <ul>
                    <li><a href="#faq">FAQ</a></li>

                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalSyarat">Syarat & Ketentuan</a></li>
<li><a href="#" data-bs-toggle="modal" data-bs-target="#modalPrivasi">Kebijakan Privasi</a></li>

                </ul>
            </div>

            {{-- Kontak --}}
            <div class="footer-section">
                <h5>Kontak</h5>
                <p><i class="bi bi-geo-alt-fill me-2"></i>Jambi, Indonesia</p>
                <p><i class="bi bi-envelope-fill me-2"></i>info@sikost.com</p>
                <p><i class="bi bi-telephone-fill me-2"></i>+62 812-3456-7890</p>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2025 SIKOST. All rights reserved.</p>
        </div>
    </div>
</footer>
{{-- ================= MODAL SYARAT & KETENTUAN ================= --}}
<div class="modal fade" id="modalSyarat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Syarat & Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="card border-0">
                    <div class="card-body">
                        <p><strong>1.</strong> Pengguna wajib memberikan data yang benar dan valid.</p>
                        <p><strong>2.</strong> Pembayaran hanya dilakukan melalui metode resmi SIKOST.</p>
                        <p><strong>3.</strong> Pembatalan dan pengembalian dana mengikuti kebijakan pemilik kos.</p>
                        <p><strong>4.</strong> SIKOST berhak menangguhkan akun jika terjadi pelanggaran.</p>
                        <p><strong>5.</strong> Dengan menggunakan layanan ini, pengguna dianggap menyetujui seluruh ketentuan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL KEBIJAKAN PRIVASI ================= --}}
<div class="modal fade" id="modalPrivasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Kebijakan Privasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="card border-0">
                    <div class="card-body">
                        <p><strong>1.</strong> Data pribadi pengguna disimpan secara aman.</p>
                        <p><strong>2.</strong> Informasi tidak dibagikan kepada pihak ketiga tanpa persetujuan.</p>
                        <p><strong>3.</strong> Data digunakan untuk keperluan layanan dan peningkatan sistem.</p>
                        <p><strong>4.</strong> Pengguna berhak meminta penghapusan data.</p>
                        <p><strong>5.</strong> Kebijakan dapat diperbarui sesuai kebutuhan operasional.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection