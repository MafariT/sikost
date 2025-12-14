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
                            <h2 class="fw-bold mb-0 text-primary">{{ $totalKamar }}</h2>
                        </div>
                        <div class="bg-primary-light rounded-3 p-3">
                            <i class="fas fa-door-open fa-lg text-primary"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0">{{ $kamarTerisi }} Terisi • {{ $kamarTersedia }} Kosong</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg-hover h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-2">Kamar Terisi</h6>
                            <h2 class="fw-bold mb-0 text-success">{{ $kamarTerisi }}</h2>
                        </div>
                        <div class="bg-success-light rounded-3 p-3">
                            <i class="fas fa-check-circle fa-lg text-success"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-0">{{ number_format($persentaseHunian, 0) }}% tingkat hunian</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg-hover h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-2">Kamar Kosong</h6>
                            <h2 class="fw-bold mb-0 text-danger">{{ $kamarTersedia }}</h2>
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
                                    <i class="fas fa-circle fa-xs me-1"></i> {{ $kamarTerisi }} Terisi
                                </span>
                            </div>
                            <div>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                    <i class="fas fa-circle fa-xs me-1"></i> {{ $kamarTersedia }} Kosong
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 pt-0">
                    <div class="table-responsive table-scroll-mobile">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th class="ps-4 py-3">No</th>
                                    <th class="py-3">No Kamar</th>
                                    <th class="py-3">Harga / Tahun</th>
                                    <th class="py-3">Status</th>
                                    <th class="text-center py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($daftarKamar as $i => $km)
                                <tr>
                                    <td class="ps-4 py-3">{{ $i+1 }}</td>
                                    <td class="py-3">
                                        <div class="fw-bold mb-1">Kamar {{ $km->no_kamar }}</div>
                                        <small class="text-muted">Lantai 1</small>
                                    </td>
                                    <td class="py-3 fw-semibold">Rp {{ number_format($km->harga,0,',','.') }}</td>
                                    <td class="py-3">
                                        @if($km->status == 'tersedia')
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                                <i class="fas fa-circle fa-xs me-1"></i> Kosong
                                            </span>
                                        @else
                                            @php
                                                $activeBooking = $km->bookings->first();
                                                $tenantName = $activeBooking->profile->nama_lengkap ?? 'Unknown';
                                            @endphp

                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                <i class="fas fa-circle fa-xs me-1"></i> Terisi
                                            </span>

                                            <div class="mt-2 d-flex align-items-center">
                                                <div class="bg-light rounded-circle p-1 me-2" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user fa-xs text-muted"></i>
                                                </div>
                                                <span class="small fw-bold text-dark">{{ $tenantName }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center py-3">
                                        <button class="btn btn-outline-primary btn-sm px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailKamar{{ $km->id_kamar }}">
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

                    <div class="text-center mb-4">
                        <h1 class="fw-bold text-primary mb-2">{{ number_format($persentaseHunian, 0) }}%</h1>
                        <p class="text-muted">Terisi {{ $kamarTerisi }} dari {{ $totalKamar }} kamar</p>
                    </div>

                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" style="width: {{ $persen ?? $persentaseHunian }}%"></div>
                    </div>

                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <h5 class="fw-bold text-success mb-1">{{ $kamarTerisi }}</h5>
                            <small class="text-muted">Terisi</small>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-bold text-secondary mb-1">{{ $kamarTersedia }}</h5>
                            <small class="text-muted">Kosong</small>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <h6 class="text-muted small">Estimasi Pendapatan Total</h6>
                        <h3 class="fw-bold text-dark">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
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
                        Riwayat Pembayaran Terbaru
                    </h4>
                    <p class="text-muted mb-0">Monitor pembayaran penyewa</p>
                </div>
                <span class="badge bg-warning bg-opacity-20 text-warning px-3 py-2">
                    <i class="fas fa-clock me-1"></i> {{ $pendingPembayaran }} Pending
                </span>
            </div>
        </div>

        <div class="card-body px-4 pt-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th class="ps-4 py-3">ID</th>
                            <th class="py-3">Penyewa</th>
                            <th class="py-3">Unit</th>
                            <th class="py-3">Jenis</th>
                            <th class="py-3">Status</th>
                            <th class="text-center py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatPembayaran as $pb)
                        <tr>
                            <td class="ps-4 py-3">#{{ $pb->id_pembayaran }}</td>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-3">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $pb->booking->profile->nama_lengkap ?? 'User' }}</span>
                                        <small class="text-muted">{{ $pb->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 fw-semibold">
                                {{ $pb->booking->kamar->no_kamar ?? '-' }}
                            </td>
                            <td class="py-3 text-uppercase small">
                                {{ str_replace('_', ' ', $pb->jenis_pembayaran) }}
                            </td>
                            <td class="py-3">
                                @if($pb->status == 'verified')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        <i class="fas fa-check-circle fa-xs me-1"></i> Lunas
                                    </span>
                                @elseif($pb->status == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                        <i class="fas fa-clock fa-xs me-1"></i> Pending
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                        <i class="fas fa-times-circle fa-xs me-1"></i> Gagal
                                    </span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <button class="btn btn-outline-success btn-sm px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailBayar{{ $pb->id_pembayaran }}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data pembayaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- KELUHAN (Placeholder) --}}
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
            </div>
        </div>

        <div class="card-body px-4 pb-4">
            <div class="alert alert-light text-center border-0">
                <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                <p class="mb-0 text-muted">Belum ada laporan keluhan masuk.</p>
            </div>
        </div>
    </div>

</section>

{{-- MODAL DETAIL KAMAR --}}
@foreach($daftarKamar as $km)
<div class="modal fade" id="detailKamar{{ $km->id_kamar }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-door-open me-2"></i>Kamar {{ $km->no_kamar }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <img src="{{ $km->foto_url }}" class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: cover;">
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Status Kamar</div>
                        @if($km->status != 'tersedia')
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">Terisi</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">Kosong</span>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Lantai</div>
                        <div class="fw-bold">1</div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="text-muted small mb-1">Harga Sewa</div>
                    <div class="fw-bold h5 text-success">Rp {{ number_format($km->harga,0,',','.') }}/tahun</div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small mb-2">Deskripsi & Fasilitas</div>
                    <div class="bg-light p-3 rounded">
                        {{ $km->deskripsi_kamar ?? 'Tidak ada deskripsi.' }}
                    </div>
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
@foreach($riwayatPembayaran as $pb)
<div class="modal fade" id="detailBayar{{ $pb->id_pembayaran }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-receipt me-2"></i>Detail Pembayaran #{{ $pb->id_pembayaran }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Penyewa</div>
                        <div class="fw-bold">{{ $pb->booking->profile->nama_lengkap ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Kamar</div>
                        <div class="fw-bold">{{ $pb->booking->kamar->no_kamar ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Jenis</div>
                        <div class="fw-bold text-uppercase">{{ str_replace('_', ' ', $pb->jenis_pembayaran) }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Tanggal</div>
                        <div class="fw-bold">{{ $pb->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="text-muted small mb-1">Jumlah Pembayaran</div>
                    <div class="fw-bold h5 text-success">Rp {{ number_format($pb->total_pembayaran,0,',','.') }}</div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <div class="text-muted small mb-1">Metode</div>
                        <div class="fw-bold">{{ $pb->metode_pembayaran ?? 'Midtrans' }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small mb-1">Status</div>
                        @if($pb->status == 'verified')
                            <span class="badge bg-success">Berhasil</span>
                        @elseif($pb->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
