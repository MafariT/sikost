@extends('layouts.layoutPenyewa')

@section('title', 'Riwayat Booking - SiKos')

@section('konten')

<style>
    .booking-section {
        padding: 60px 0;
        background-color: #f8f9fa;
        min-height: 90vh;
    }

    /* Styling Card Booking Utama */
    .booking-card {
        border: none;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        margin-bottom: 30px;
        overflow: hidden;
    }

    .booking-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    /* Styling Gambar Kos */
    .booking-img-wrapper {
        height: 100%;
        min-height: 200px;
        position: relative;
    }

    .booking-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Label Status (Pojok Kiri Atas Gambar) */
    .booking-status-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    /* Status Colors */
    .status-active { background-color: #d1e7dd; color: #0f5132; } /* Hijau */
    .status-pending { background-color: #fff3cd; color: #664d03; } /* Kuning */
    .status-finished { background-color: #e2e3e5; color: #41464b; } /* Abu */

    /* Bagian Header Card */
    .booking-header {
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    /* Detail Item (Ikon + Teks) */
    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        color: #6c757d;
        font-size: 0.95rem;
    }
    .detail-item i {
        width: 25px;
        text-align: center;
        margin-right: 10px;
        color: #0d6efd;
    }

    /* Tombol Toggle Riwayat Pembayaran */
    .btn-toggle-history {
        background-color: #f1f8ff;
        color: #0d6efd;
        border: none;
        font-weight: 600;
        width: 100%;
        text-align: left;
        padding: 12px 20px;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .btn-toggle-history:hover {
        background-color: #e7f1ff;
        color: #0a58ca;
    }

    /* Styling Tabel Riwayat Pembayaran */
    .history-table thead th {
        background-color: #f8f9fa;
        border-top: none;
        font-size: 0.85rem;
        text-transform: uppercase;
        color: #888;
    }
    .history-container {
        background-color: #fff;
        padding: 20px;
        border-top: 1px dashed #dee2e6;
    }
</style>

<section class="booking-section">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold mb-1">Riwayat Booking</h2>
                <p class="text-muted">Kelola sewa kos dan pantau riwayat pembayaranmu.</p>
            </div>
            <div class="d-none d-md-block">
                <select class="form-select w-auto">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Selesai</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">

                <div class="booking-card">
                    <div class="row g-0">
                        <div class="col-md-4 booking-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600" class="booking-img" alt="Kos Image">
                            <span class="booking-status-badge status-active">
                                <i class="fas fa-check-circle me-1"></i> Sewa Aktif
                            </span>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <div class="booking-header d-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title fw-bold mb-1">Kos Melati Residence</h4>
                                        <small class="text-muted">ID Booking: #BK-2023-001</small>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fw-bold text-primary mb-0">Rp 1.200.000</h5>
                                        <small class="text-muted">/ bulan</small>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <i class="fas fa-map-marker-alt"></i> Kukusan, Depok
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-bed"></i> Kamar Tipe A (No. 12)
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <i class="fas fa-calendar-alt"></i> Mulai: 25 Sep 2023
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-clock"></i> Durasi: Per Bulan
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex gap-2 mb-2">
                                        <button class="btn btn-primary flex-grow-1 fw-bold">
                                            <i class="fas fa-wallet me-2"></i> Bayar Bulan Ini
                                        </button>
                                        <button class="btn btn-outline-secondary">
                                            <i class="fas fa-comment-dots"></i> Chat Owner
                                        </button>
                                    </div>

                                    <button class="btn-toggle-history" type="button" data-bs-toggle="collapse" data-bs-target="#historyCollapse1" aria-expanded="false">
                                        <span><i class="fas fa-receipt me-2"></i> Lihat Riwayat Pembayaran</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="historyCollapse1">
                        <div class="history-container">
                            <h6 class="fw-bold mb-3 ms-2">Catatan Transaksi</h6>
                            <div class="table-responsive">
                                <table class="table table-hover history-table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Periode Tagihan</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Metode</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-warning">
                                            <td class="fw-bold">Desember 2023</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>Rp 1.200.000</td>
                                            <td><span class="badge bg-warning text-dark rounded-pill">Belum Dibayar</span></td>
                                            <td><a href="#" class="btn btn-sm btn-primary">Bayar</a></td>
                                        </tr>
                                        <tr>
                                            <td>November 2023</td>
                                            <td>24 Nov 2023</td>
                                            <td>Transfer BCA</td>
                                            <td>Rp 1.200.000</td>
                                            <td><span class="badge bg-success rounded-pill">Lunas</span></td>
                                            <td><a href="#" class="btn btn-sm btn-light border"><i class="fas fa-download"></i> Invoice</a></td>
                                        </tr>
                                        <tr>
                                            <td>Oktober 2023</td>
                                            <td>25 Okt 2023</td>
                                            <td>Gopay</td>
                                            <td>Rp 1.200.000</td>
                                            <td><span class="badge bg-success rounded-pill">Lunas</span></td>
                                            <td><a href="#" class="btn btn-sm btn-light border"><i class="fas fa-download"></i> Invoice</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="booking-card">
                    <div class="row g-0">
                        <div class="col-md-4 booking-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600" class="booking-img" style="filter: grayscale(80%);" alt="Kos Image">
                            <span class="booking-status-badge status-finished">
                                <i class="fas fa-history me-1"></i> Selesai
                            </span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <div class="booking-header d-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title fw-bold mb-1 text-muted">Kos Mawar Indah</h4>
                                        <small class="text-muted">ID Booking: #BK-2022-098</small>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fw-bold text-muted mb-0">Rp 950.000</h5>
                                        <small class="text-muted">/ bulan</small>
                                    </div>
                                </div>

                                <div class="row mb-4 text-muted">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <i class="fas fa-map-marker-alt text-secondary"></i> Dago, Bandung
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-bed text-secondary"></i> Kamar Standar
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <i class="fas fa-calendar-check text-secondary"></i> Berakhir: 20 Aug 2023
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-file-contract text-secondary"></i> Durasi: 6 Bulan
                                        </div>
                                    </div>
                                </div>

                                <button class="btn-toggle-history bg-light text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#historyCollapse2" aria-expanded="false">
                                    <span><i class="fas fa-receipt me-2"></i> Lihat Arsip Pembayaran</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                
                                <div class="mt-3">
                                    <a href="#" class="text-decoration-none small text-muted">
                                        <i class="fas fa-redo me-1"></i> Pesan Lagi Kos Ini?
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="historyCollapse2">
                        <div class="history-container bg-light">
                            <h6 class="fw-bold mb-3 ms-2 text-muted">Arsip Transaksi</h6>
                            <div class="table-responsive">
                                <table class="table table-sm text-muted">
                                    <thead>
                                        <tr>
                                            <th>Periode</th>
                                            <th>Tanggal</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Agustus 2023</td>
                                            <td>20 Agt 2023</td>
                                            <td>Rp 950.000</td>
                                            <td>Lunas</td>
                                        </tr>
                                        <tr>
                                            <td>Juli 2023</td>
                                            <td>20 Jul 2023</td>
                                            <td>Rp 950.000</td>
                                            <td>Lunas</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-center fst-italic pt-3">... Data sebelumnya disembunyikan ...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</section>

@endsection