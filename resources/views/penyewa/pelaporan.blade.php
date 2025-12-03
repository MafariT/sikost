@extends('layouts.layoutPenyewa')

@section('title', 'Pelaporan Keluhan - SiKos')

@section('konten')

{{-- HERO SECTION (mirip beranda, tapi khusus pelaporan) --}}
<section class="hero-section" id="pelaporan-hero">
    <div class="container">
        <div class="row align-items-center">
            {{-- Text --}}
            <div class="col-lg-6 hero-content">
                <h1>Laporkan Keluhan Kamar dengan Cepat</h1>
                <p>
                    Sampaikan keluhan terkait kamar dan fasilitas kos secara online. 
                    Admin dan petugas kos akan menerima laporanmu dan menindaklanjuti dengan lebih terstruktur.
                </p>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    <span class="badge bg-primary-subtle text-primary">
                        <i class="fas fa-bolt me-1"></i> Respons lebih cepat
                    </span>
                    <span class="badge bg-success-subtle text-success">
                        <i class="fas fa-clipboard-check me-1"></i> Status terpantau
                    </span>
                    <span class="badge bg-info-subtle text-info">
                        <i class="fas fa-file-alt me-1"></i> Riwayat tersimpan
                    </span>
                </div>
            </div>

            {{-- Ilustrasi / angka ringkas --}}
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800"
                         alt="Pelaporan Kos">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION UTAMA PELAPORAN --}}
<section class="features-section" id="pelaporan-main">
    <div class="container">

        <div class="section-title">
            <h2>Kelola Pelaporan</h2>
            <p>Satu halaman untuk membuat keluhan baru dan memantau riwayat pelaporanmu</p>
        </div>

        <div class="row g-4">
            {{-- FORM PELAPORAN (kiri) --}}
            <div class="col-lg-5">
                <div class="feature-card" style="padding: 24px;">
                    <div class="feature-icon">
                        <i class="fas fa-triangle-exclamation"></i>
                    </div>
                    <h3 class="mb-3">Buat Pelaporan Baru</h3>
                    <p class="text-muted">
                        Isi form di bawah ini untuk mengirim keluhan terkait kamar atau fasilitas kos.
                        Sertakan foto agar petugas lebih mudah melakukan pengecekan.
                    </p>

                    {{-- Notifikasi sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success py-2 px-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Notifikasi error --}}
                    @if($errors->any())
                        <div class="alert alert-danger py-2 px-3">
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pelaporan.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf

                        {{-- No Kamar --}}
                        <div class="mb-3 text-start">
                            <label class="form-label">Nomor Kamar</label>
                            <input type="text" name="no_kamar" class="form-control" placeholder="Contoh: A-21">
                        </div>

                        {{-- Keluhan --}}
                        <div class="mb-3 text-start">
                            <label class="form-label">Judul Keluhan <span class="text-danger">*</span></label>
                            <input type="text" name="keluhan" class="form-control" required
                                   placeholder="Contoh: Air kamar mandi tidak mengalir">
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3 text-start">
                            <label class="form-label">Deskripsi Keluhan</label>
                            <textarea name="deskripsi_keluhan" rows="3" class="form-control"
                                      placeholder="Tuliskan detail keluhan, sejak kapan, dan kondisi terkini."></textarea>
                        </div>

                        {{-- Foto bukti --}}
                        <div class="mb-3 text-start">
                            <label class="form-label">Foto Bukti (opsional)</label>
                            <input type="file" name="foto_bukti" class="form-control">
                            <small class="text-muted">
                                Format jpg, jpeg, png maksimal 2 MB.
                            </small>
                        </div>

                        <button class="btn btn-search w-100 mt-2">
                            <i class="fas fa-paper-plane me-1"></i> Kirim Pelaporan
                        </button>
                    </form>
                </div>
            </div>

            {{-- RIWAYAT PELAPORAN (kanan) --}}
            <div class="col-lg-7">
                <div class="kos-card" style="height: 100%;">
                    <div class="kos-content">
                        <h3 class="kos-title mb-2">
                            Riwayat Pelaporan Saya
                        </h3>
                        <p class="text-muted mb-3">
                            Lihat status terbaru dari keluhan yang sudah kamu kirim ke pengelola kos.
                        </p>

                        @if($pelaporan->isEmpty())
                            <p class="text-muted mb-0">
                                Kamu belum pernah mengirim pelaporan. Buat pelaporan pertama di form sebelah kiri.
                            </p>
                        @else
                            <div class="table-responsive mt-2">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keluhan</th>
                                            <th>No. Kamar</th>
                                            <th>Waktu</th>
                                            <th>Status Admin</th>
                                            <th>Status Petugas</th>
                                            <th>Bukti</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pelaporan as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                {{-- keluhan + deskripsi singkat --}}
                                                <td style="max-width: 220px;">
                                                    <strong>{{ $p->keluhan }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ \Illuminate\Support\Str::limit($p->deskripsi_keluhan, 60) ?? '-' }}
                                                    </small>
                                                </td>

                                                <td>{{ $p->no_kamar ?? '-' }}</td>

                                                {{-- waktu + tanggal --}}
                                                <td>
                                                    <small class="d-block">
                                                        {{ $p->tanggal_keluhan ?? $p->created_at->format('d-m-Y') }}
                                                    </small>
                                                    <small class="text-muted">
                                                        {{ $p->waktu_keluhan ? \Carbon\Carbon::parse($p->waktu_keluhan)->format('H:i') : $p->created_at->format('H:i') }}
                                                    </small>
                                                </td>

                                                {{-- status admin --}}
                                                <td>
                                                    @php
                                                        $statusAdmin = $p->status_admin ?? 'Menunggu';
                                                    @endphp
                                                    <span class="badge
                                                        @if($statusAdmin === 'Diterima') bg-success
                                                        @elseif($statusAdmin === 'Ditolak') bg-danger
                                                        @else bg-secondary
                                                        @endif">
                                                        {{ $statusAdmin }}
                                                    </span>
                                                </td>

                                                {{-- status OB / petugas --}}
                                                <td>
                                                    @php
                                                        $statusOb = $p->status_ob ?? 'Belum diproses';
                                                    @endphp
                                                    <span class="badge
                                                        @if($statusOb === 'Selesai') bg-success
                                                        @elseif($statusOb === 'Dalam Proses') bg-warning text-dark
                                                        @else bg-secondary
                                                        @endif">
                                                        {{ $statusOb }}
                                                    </span>
                                                </td>

                                                {{-- foto bukti / after --}}
                                                <td>
                                                    @if($p->foto_bukti)
                                                        <a href="{{ asset('storage/'.$p->foto_bukti) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-primary mb-1 d-block">
                                                            Bukti
                                                        </a>
                                                    @endif
                                                    @if($p->foto_after_perbaikan)
                                                        <a href="{{ asset('storage/'.$p->foto_after_perbaikan) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-success d-block">
                                                            After
                                                        </a>
                                                    @endif
                                                    @if(!$p->foto_bukti && !$p->foto_after_perbaikan)
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- CTA KECIL DI BAWAH, opsional --}}
<section class="cta-section">
    <div class="container">
        <h2>Butuh bantuan tambahan?</h2>
        <p>Jika keluhanmu belum tertangani, hubungi admin kos melalui kontak yang tersedia di aplikasi.</p>
        <button class="btn btn-light-custom">
            Lihat Kontak Pengelola <i class="fas fa-arrow-right ms-2"></i>
        </button>
    </div>
</section>

@endsection
