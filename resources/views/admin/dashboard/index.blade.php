@extends('admin.layout.mainLayoutAdmin')

@section('title', 'Dashboard Admin')

@section('konten')
<div class="page-header">
    <h1>Dashboard</h1>
    <p>Selamat datang di panel admin KostKu</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">156</div>
                <div class="stat-label">Total Kamar</div>
            </div>
            <div class="stat-icon blue">
                <i class="fas fa-bed"></i>
            </div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-header">
            <div>
                <div class="stat-value">89</div>
                <div class="stat-label">Kamar Terisi</div>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-header">
            <div>
                <div class="stat-value">67</div>
                <div class="stat-label">Kamar Tersedia</div>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-header">
            <div>
                <div class="stat-value">12</div>
                <div class="stat-label">Laporan Baru</div>
            </div>
            <div class="stat-icon purple">
                <i class="fas fa-flag"></i>
            </div>
        </div>
    </div>
</div>

<!-- Chart Container -->
<div class="chart-container">
    <div class="chart-header">
        <h3>Statistik Booking Bulanan</h3>
    </div>
    <div
        style="height: 300px; display: flex; align-items: center; justify-content: center; background: var(--porcelain); border-radius: 10px;">
        <p style="color: var(--china); font-size: 1rem;">Chart akan ditampilkan di sini</p>
    </div>
</div>

<!-- Recent Activity -->
<div class="activity-list">
    <div class="chart-header">
        <h3>Aktivitas Terbaru</h3>
    </div>

    <div class="activity-item">
        <div class="activity-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <div class="activity-details">
            <h5>Penghuni Baru Terdaftar</h5>
            <p>Budi Santoso mendaftar di Kamar 101 - 2 jam yang lalu</p>
        </div>
    </div>

    <div class="activity-item">
        <div class="activity-icon">
            <i class="fas fa-flag"></i>
        </div>
        <div class="activity-details">
            <h5>Laporan Baru Masuk</h5>
            <p>Laporan kerusakan AC di Kamar 205 - 3 jam yang lalu</p>
        </div>
    </div>

    <div class="activity-item">
        <div class="activity-icon">
            <i class="fas fa-money-bill"></i>
        </div>
        <div class="activity-details">
            <h5>Pembayaran Diterima</h5>
            <p>Pembayaran sewa bulan Januari dari Kamar 303 - 5 jam yang lalu</p>
        </div>
    </div>

    <div class="activity-item">
        <div class="activity-icon">
            <i class="fas fa-edit"></i>
        </div>
        <div class="activity-details">
            <h5>Data Kamar Diperbarui</h5>
            <p>Informasi fasilitas Kamar 108 telah diperbarui - 1 hari yang lalu</p>
        </div>
    </div>
</div>
@endsection
