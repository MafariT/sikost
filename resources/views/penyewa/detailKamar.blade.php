@extends('layouts.layoutPenyewa')

@section('title', 'Detail Kamar ' . $kamar->no_kamar . ' - SiKos')

@section('konten')
<link rel="stylesheet" href="{{ asset('css/kamarPenyewa.css') }}">

<div class="detail-section">
    <div class="container">
        <div class="detail-container">
            <div class="image-gallery">
                <img src="{{ Storage::disk('s3')->url($kamar->foto_kamar) }}"
                     alt="Kamar {{ $kamar->no_kamar }}"
                     class="main-image"
                     id="mainImage">

                @if($kamar->status == 'tersedia')
                    <div class="image-badge" style="background-color: #28a745;">Tersedia</div>
                @else
                    <div class="image-badge" style="background-color: #dc3545;">Tidak Tersedia</div>
                @endif
            </div>

            <!-- Content -->
            <div class="detail-content">
                <div class="room-header">
                    <div class="room-title">
                        <h1>Kamar {{ $kamar->no_kamar }}</h1>
                        <div class="room-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>SiKost Area Utama, Jambi</span>
                        </div>
                    </div>
                    <div class="room-price">
                        <div class="price-amount">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</div>
                        <div class="price-period">per-tahun</div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="info-text">
                            <h4>Nomor Kamar</h4>
                            <p>{{ $kamar->no_kamar }}</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-ruler-combined"></i>
                        </div>
                        <div class="info-text">
                            <h4>Ukuran</h4>
                            <p>3 x 4 meter</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="info-text">
                            <h4>Kapasitas</h4>
                            <p>1 Orang</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="info-text">
                            <h4>Tipe Kamar</h4>
                            <p>Single Bed</p>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="section-block">
                    <h2>Deskripsi</h2>
                    <p class="description-text">
                        {{ $kamar->deskripsi_kamar ?? 'Tidak ada deskripsi tersedia untuk kamar ini.' }}
                    </p>
                </div>

                <!-- Fasilitas -->
                <div class="section-block">
                    <h2>Fasilitas Kamar</h2>
                    <div class="facilities-grid">
                      <div class="facility-item">
                            <i class="fas fa-snowflake"></i>
                            <span>AC</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-wifi"></i>
                            <span>WiFi Gratis</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-bed"></i>
                            <span>Kasur + Bantal</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-tshirt"></i>
                            <span>Lemari Pakaian</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-chair"></i>
                            <span>Meja & Kursi Belajar</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-shower"></i>
                            <span>Kamar Mandi Dalam</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-plug"></i>
                            <span>Stop Kontak</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-lightbulb"></i>
                            <span>Penerangan 24 Jam</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-parking"></i>
                            <span>Area Parkir</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>CCTV 24 Jam</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-broom"></i>
                            <span>Cleaning Service</span>
                        </div>
                        <div class="facility-item">
                            <i class="fas fa-utensils"></i>
                            <span>Dapur Bersama</span>
                        </div>
                    </div>
                </div>

                <!-- Peraturan -->
                <div class="section-block">
                    <h2>Peraturan Kos</h2>
                    <ul class="rules-list">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Tidak boleh merokok</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Tamu wajib lapor ke pengelola maksimal jam 21.00 WIB</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Menjaga kebersihan dan ketertiban lingkungan</span>
                        </li>
                        <li>
                            <i class="fas fa-ban"></i>
                            <span>Dilarang membawa hewan peliharaan</span>
                        </li>
                        <li>
                            <i class="fas fa-ban"></i>
                            <span>Dilarang membuat keributan setelah jam 22.00 WIB</span>
                        </li>
                        <li>
                            <i class="fas fa-ban"></i>
                            <span>Dilarang merokok di dalam kamar</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-section">
                <a href="{{ route('kamar.index') }}" class="btn-contact" style="text-decoration: none;">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>

                @if($kamar->status == 'tersedia')
                    <a href="{{ route('booking.create', $kamar->id_kamar) }}" class="btn-booking" style="text-decoration: none;">
                        <i class="fas fa-calendar-check"></i>
                        <span>Booking Sekarang</span>
                    </a>
                @else
                    <button class="btn-booking" style="background-color: #6c757d; cursor: not-allowed; border:none;" disabled>
                        <i class="fas fa-times-circle"></i>
                        <span>Kamar Penuh</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
