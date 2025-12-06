@extends('layouts.layoutPemilik')

@section('title', 'SiKos Owner - Dashboard Pemilik')

@section('konten')
<section class="pemilik-dashboard">

    {{-- JUDUL --}}
    <div class="mb-5" id="dashboard-section">
        <h1 class="fw-bold text-dark mb-2 dashboard-title">
            <i class="fas fa-home me-3 text-primary"></i> Dashboard Pemilik Kos
        </h1>
        <p class="text-muted mb-0 dashboard-subtitle">
            Selamat datang, <span class="fw-semibold text-primary">Pemilik Kos</span> • 
            Pantau kinerja kos Anda secara real-time
        </p>
    </div>

    {{-- CARD SUMMARY --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg-hover h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-2">Total Kamar</h6>
                            <h2 class="fw-bold mb-0 text-primary">12</h2>
                        </div>
                        <div class="bg-primary-light rounded-3 p-3">
                            <i class="fas fa-door-open fa-lg text-primary"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0">8 Terisi • 4 Kosong</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg-hover h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-2">Kamar Terisi</h6>
                            <h2 class="fw-bold mb-0 text-success">8</h2>
                        </div>
                        <div class="bg-success-light rounded-3 p-3">
                            <i class="fas fa-check-circle fa-lg text-success"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0">67% tingkat hunian</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg-hover h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-2">Kamar Kosong</h6>
                            <h2 class="fw-bold mb-0 text-danger">4</h2>
                        </div>
                        <div class="bg-danger-light rounded-3 p-3">
                            <i class="fas fa-times-circle fa-lg text-danger"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0">Tersedia untuk disewa</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ATAS: KAMAR & PERSENTASE HUNIAN --}}
    <div class="row g-4 mb-5">
        
        {{-- KAMAR SECTION --}}
        <div class="col-lg-8" id="kamar-section">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pb-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">
                                <i class="fas fa-building me-2 text-primary"></i>
                                Daftar Unit Kamar
                            </h4>
                            <p class="text-muted mb-0">Overview kondisi kamar kos</p>
                        </div>
                        <div class="d-flex">
                            <div class="me-3">
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                    <i class="fas fa-circle fa-xs me-1"></i> 8 Terisi
                                </span>
                            </div>
                            <div>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                    <i class="fas fa-circle fa-xs me-1"></i> 4 Kosong
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th class="ps-4 py-3">No</th>
                                    <th class="py-3">Nama Kamar</th>
                                    <th class="py-3">Harga / Bulan</th>
                                    <th class="py-3">Status</th>
                                    <th class="text-center py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $dummyKamar = [
                                        ['nama'=>'Kamar A1','status'=>'terisi','harga'=>750000,'lantai'=>1,'fasilitas'=>['Kasur', 'Lemari', 'AC', 'Kamar Mandi Dalam']],
                                        ['nama'=>'Kamar A2','status'=>'kosong','harga'=>750000,'lantai'=>1,'fasilitas'=>['Kasur', 'Lemari', 'Kipas Angin', 'Kamar Mandi Luar']],
                                        ['nama'=>'Kamar B1','status'=>'terisi','harga'=>800000,'lantai'=>2,'fasilitas'=>['Kasur Besar', 'Lemari', 'AC', 'TV', 'Kamar Mandi Dalam']],
                                        ['nama'=>'Kamar B2','status'=>'kosong','harga'=>800000,'lantai'=>2,'fasilitas'=>['Kasur Besar', 'Lemari', 'AC', 'Kamar Mandi Dalam']],
                                        ['nama'=>'Kamar C1','status'=>'terisi','harga'=>700000,'lantai'=>3,'fasilitas'=>['Kasur', 'Lemari', 'Kipas Angin', 'Kamar Mandi Luar']],
                                    ];
                                @endphp

                                @foreach($dummyKamar as $i => $km)
                                <tr>
                                    <td class="ps-4 py-3">{{ $i+1 }}</td>
                                    <td class="py-3">
                                        <div class="fw-bold mb-1">{{ $km['nama'] }}</div>
                                        <small class="text-muted">Lantai {{ $km['lantai'] }}</small>
                                    </td>
                                    <td class="py-3 fw-semibold">Rp {{ number_format($km['harga'],0,',','.') }}</td>
                                    <td class="py-3">
                                        @if($km['status']=='terisi')
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                <i class="fas fa-circle fa-xs me-1"></i> Terisi
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                                <i class="fas fa-circle fa-xs me-1"></i> Kosong
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center py-3">
                                        <button class="btn btn-outline-primary btn-sm px-3" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailKamar{{$i}}">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- PERSENTASE HUNIAN --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-chart-pie me-2 text-warning"></i>
                        Tingkat Hunian Kos
                    </h5>
                    
                    @php
                        $total = 12;
                        $terisi = 8;
                        $persen = ($terisi / $total) * 100;
                    @endphp

                    <div class="text-center mb-4">
                        <h1 class="fw-bold text-primary mb-2">{{ number_format($persen, 0) }}%</h1>
                        <p class="text-muted">Terisi {{ $terisi }} dari {{ $total }} kamar</p>
                    </div>
                    
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" style="width: {{ $persen }}%"></div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <h5 class="fw-bold text-success mb-1">8</h5>
                            <small class="text-muted">Terisi</small>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-bold text-secondary mb-1">4</h5>
                            <small class="text-muted">Kosong</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- PEMBAYARAN --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4" id="pembayaran-section">
        <div class="card-header bg-white border-0 pb-0 pt-4 px-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">
                        <i class="fas fa-money-bill-wave me-2 text-success"></i>
                        Riwayat Pembayaran
                    </h4>
                    <p class="text-muted mb-0">Monitor pembayaran penyewa</p>
                </div>
                <span class="badge bg-warning bg-opacity-20 text-warning px-3 py-2">
                    <i class="fas fa-clock me-1"></i> 1 Pending
                </span>
            </div>
        </div>

        <div class="card-body px-4 pt-0">
            @php
                $dummyBayar = [
                    ['nama'=>'Siti Nur','kamar'=>'A1','bulan'=>'Desember 2023','status'=>'Lunas','jumlah'=>750000,'metode'=>'Transfer Bank','tanggal'=>'15 Des 2023'],
                    ['nama'=>'Rina','kamar'=>'B1','bulan'=>'Desember 2023','status'=>'Pending','jumlah'=>800000,'metode'=>'Transfer Bank','tanggal'=>'18 Des 2023'],
                    ['nama'=>'Budi','kamar'=>'C1','bulan'=>'Desember 2023','status'=>'Lunas','jumlah'=>700000,'metode'=>'Cash','tanggal'=>'10 Des 2023'],
                ];
            @endphp

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Penyewa</th>
                            <th class="py-3">Unit</th>
                            <th class="py-3">Bulan</th>
                            <th class="py-3">Status</th>
                            <th class="text-center py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dummyBayar as $i => $pb)
                        <tr>
                            <td class="ps-4 py-3">{{ $i + 1 }}</td>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-3">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                    <span>{{ $pb['nama'] }}</span>
                                </div>
                            </td>
                            <td class="py-3 fw-semibold">{{ $pb['kamar'] }}</td>
                            <td class="py-3">{{ $pb['bulan'] }}</td>
                            <td class="py-3">
                                @if($pb['status']=='Lunas')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        <i class="fas fa-check-circle fa-xs me-1"></i> Lunas
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                        <i class="fas fa-clock fa-xs me-1"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <button class="btn btn-outline-success btn-sm px-3" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailBayar{{$i}}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- KELUHAN --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4" id="keluhan-section">
        <div class="card-header bg-white border-0 pb-0 pt-4 px-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">
                        <i class="fas fa-exclamation-circle me-2 text-danger"></i>
                        Laporan Keluhan Penyewa
                    </h4>
                    <p class="text-muted mb-0">Keluhan yang perlu perhatian</p>
                </div>
                <span class="badge bg-danger bg-opacity-20 text-danger px-3 py-2">
                    <i class="fas fa-exclamation me-1"></i> 1 Dalam Proses
                </span>
            </div>
        </div>

        <div class="card-body px-4 pt-0">
            @php
                $dummyKeluhan = [
                    ['nama'=>'Siti Nur','kamar'=>'A1','isi'=>'Lampu kamar utama mati total, sudah dicek bukan masalah dari lampunya.','status'=>'Proses','foto_bukti'=>'https://via.placeholder.com/400x300/FF5722/FFFFFF?text=Lampu+Mati','foto_perbaikan'=>null,'tanggal'=>'20 Des 2023','admin_note'=>'Sedang dicek oleh teknisi'],
                    ['nama'=>'Rina','kamar'=>'B1','isi'=>'AC tidak dingin, suhu tidak turun meski sudah di setting minimum.','status'=>'Selesai','foto_bukti'=>'https://via.placeholder.com/400x300/FF5722/FFFFFF?text=AC+Rusak','foto_perbaikan'=>'https://via.placeholder.com/400x300/4CAF50/FFFFFF?text=AC+Sudah+Diperbaiki','tanggal'=>'15 Des 2023','admin_note'=>'AC sudah dibersihkan dan ditambahkan freon. Berfungsi normal kembali.'],
                    ['nama'=>'Budi','kamar'=>'C1','isi'=>'Keran air di kamar mandi bocor dan perlu penggantian segera.','status'=>'Selesai','foto_bukti'=>'https://via.placeholder.com/400x300/FF5722/FFFFFF?text=Keran+Bocor','foto_perbaikan'=>'https://via.placeholder.com/400x300/4CAF50/FFFFFF?text=Keran+Baru+Terpasang','tanggal'=>'10 Des 2023','admin_note'=>'Keran sudah diganti dengan yang baru. Tidak ada kebocoran lagi.'],
                ];
            @endphp

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Penyewa</th>
                            <th class="py-3">Kamar</th>
                            <th class="py-3">Keluhan</th>
                            <th class="py-3">Status</th>
                            <th class="text-center py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dummyKeluhan as $i => $kl)
                        <tr>
                            <td class="ps-4 py-3">{{ $i + 1 }}</td>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-3">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                    <span>{{ $kl['nama'] }}</span>
                                </div>
                            </td>
                            <td class="py-3 fw-semibold">{{ $kl['kamar'] }}</td>
                            <td class="py-3">
                                <div class="text-truncate keluhan-preview">
                                    {{ $kl['isi'] }}
                                </div>
                            </td>
                            <td class="py-3">
                                @if($kl['status']=='Selesai')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        <i class="fas fa-check-circle fa-xs me-1"></i> Selesai
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                        <i class="fas fa-tools fa-xs me-1"></i> Proses
                                    </span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <button class="btn btn-outline-danger btn-sm px-3" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailKeluhan{{$i}}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

{{-- MODAL DETAIL KAMAR --}}
@foreach($dummyKamar as $i => $km)
<div class="modal fade" id="detailKamar{{$i}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-door-open me-2"></i>{{ $km['nama'] }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Status Kamar</div>
                        @if($km['status']=='terisi')
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-circle fa-xs me-1"></i> Terisi
                            </span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                <i class="fas fa-circle fa-xs me-1"></i> Kosong
                            </span>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Lantai</div>
                        <div class="fw-bold">Lantai {{ $km['lantai'] }}</div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="text-muted small mb-1">Harga Sewa</div>
                    <div class="fw-bold h5 text-success">Rp {{ number_format($km['harga'],0,',','.') }}/bulan</div>
                </div>
                
                <div class="mb-3">
                    <div class="text-muted small mb-2">Fasilitas Kamar</div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($km['fasilitas'] as $fasilitas)
                            <span class="badge bg-light text-dark px-3 py-2">
                                <i class="fas fa-check-circle fa-xs me-1 text-success"></i>{{ $fasilitas }}
                            </span>
                        @endforeach
                    </div>
                </div>
                
                <div class="alert alert-primary bg-primary-light border-0 mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Kamar ini {{ $km['status'] == 'terisi' ? 'sedang ditempati penyewa' : 'tersedia untuk disewa' }}
                </div>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- MODAL DETAIL PEMBAYARAN --}}
@foreach($dummyBayar as $i => $pb)
<div class="modal fade" id="detailBayar{{$i}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-receipt me-2"></i>Detail Pembayaran
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Penyewa</div>
                        <div class="fw-bold">{{ $pb['nama'] }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Kamar</div>
                        <div class="fw-bold">{{ $pb['kamar'] }}</div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Bulan</div>
                        <div class="fw-bold">{{ $pb['bulan'] }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Tanggal</div>
                        <div class="fw-bold">{{ $pb['tanggal'] }}</div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="text-muted small mb-1">Jumlah Pembayaran</div>
                    <div class="fw-bold h5 text-success">Rp {{ number_format($pb['jumlah'],0,',','.') }}</div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Metode Pembayaran</div>
                        <div class="fw-bold">{{ $pb['metode'] }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Status</div>
                        @if($pb['status']=='Lunas')
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-check-circle fa-xs me-1"></i> Lunas
                            </span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                <i class="fas fa-clock fa-xs me-1"></i> Pending
                            </span>
                        @endif
                    </div>
                </div>
                
                @if($pb['status']=='Pending')
                <div class="alert alert-warning bg-warning-light border-0">
                    <i class="fas fa-clock me-2"></i>
                    Pembayaran menunggu verifikasi admin
                </div>
                @endif
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- MODAL DETAIL KELUHAN --}}
@foreach($dummyKeluhan as $i => $kl)
<div class="modal fade" id="detailKeluhan{{$i}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-exclamation-circle me-2"></i>Detail Keluhan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Penyewa</div>
                        <div class="fw-bold">{{ $kl['nama'] }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Kamar</div>
                        <div class="fw-bold">{{ $kl['kamar'] }}</div>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Tanggal Laporan</div>
                        <div class="fw-bold">{{ $kl['tanggal'] }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Status</div>
                        @if($kl['status']=='Selesai')
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-check-circle fa-xs me-1"></i> Selesai
                            </span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                <i class="fas fa-tools fa-xs me-1"></i> Proses
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="text-muted small mb-2">Deskripsi Keluhan</div>
                    <div class="card bg-light border-0 p-3">
                        <p class="mb-0">{{ $kl['isi'] }}</p>
                    </div>
                </div>
                
                {{-- FOTO BUKTI KELUHAN --}}
                <div class="mb-4">
                    <div class="text-muted small mb-2">Foto Bukti Keluhan</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-0 overflow-hidden">
                                <img src="{{ $kl['foto_bukti'] }}" class="img-fluid rounded" alt="Bukti Keluhan">
                                <div class="card-footer bg-light text-center py-2">
                                    <small class="text-muted">Foto keluhan dari penyewa</small>
                                </div>
                            </div>
                        </div>
                        
                        {{-- FOTO PERBAIKAN JIKA SUDAH SELESAI --}}
                        @if($kl['status'] == 'Selesai' && $kl['foto_perbaikan'])
                        <div class="col-md-6">
                            <div class="card border-0 overflow-hidden">
                                <img src="{{ $kl['foto_perbaikan'] }}" class="img-fluid rounded" alt="Bukti Perbaikan">
                                <div class="card-footer bg-light text-center py-2">
                                    <small class="text-muted">Foto setelah diperbaiki</small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                {{-- CATATAN ADMIN --}}
                @if($kl['admin_note'])
                <div class="alert alert-info bg-info-light border-0">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-user-cog fa-lg me-3 mt-1"></i>
                        <div>
                            <div class="fw-bold mb-1">Catatan Admin</div>
                            <p class="mb-0">{{ $kl['admin_note'] }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($kl['status'] != 'Selesai')
                <div class="alert alert-warning bg-warning-light border-0">
                    <i class="fas fa-tools me-2"></i>
                    Keluhan sedang dalam proses penanganan oleh teknisi
                </div>
                @endif
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection