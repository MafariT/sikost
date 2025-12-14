@extends('layouts.layoutPenyewa')

@section('konten')

    {{-- CSS INTERNAL --}}
    <style>
        .page-offset {
            padding-top: 120px !important;
        }

        body {
            background-color: var(--color-asean-pear);
            color: var(--color-midnight);
        }

        /* Kartu & Header */
        .card-booking {
            border: none;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card-booking:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(51, 78, 172, 0.15);
        }

        .booking-header {
            background-color: var(--color-porcelain);
            padding: 15px 25px;
            border-bottom: 1px solid #e0e6ed;
        }

        /* Helper Classes Status */
        .card-disabled {
            opacity: 0.75;
            background-color: #fcfcfc;
        }

        .header-disabled {
            background-color: #eee;
        }

        /* Table & Pagination */
        .table-simple th {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--color-royal);
            letter-spacing: 1px;
            border-bottom: 2px solid var(--color-porcelain);
        }

        .table-simple td {
            font-size: 0.9rem;
            vertical-align: middle;
            padding: 12px 10px;
            color: var(--midnight);
        }

        .dashed-line {
            border-top: 2px dashed var(--color-sky);
            margin: 20px 0;
        }

        /* ================================================ */

        .pagination-modern {
            gap: 5px;
        }

        .pagination-modern .page-link {
            border: 1px solid var(--color-porcelain) !important;
            border-radius: 8px !important;
            padding: 6px 14px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-royal) !important;
            background-color: #fff !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 35px;
            height: 35px;
        }

        .pagination-modern .page-link:hover {
            background-color: var(--color-dawn) !important;
            transform: translateY(-1px);
        }

        .pagination-modern .page-item.active .page-link {
            background-color: var(--color-royal) !important;
            color: #fff !important;
            border-color: var(--color-royal) !important;
            box-shadow: 0 4px 12px rgba(51, 78, 172, 0.3);
        }

        .pagination-modern .page-item.disabled .page-link {
            background-color: #f8f9fa !important;
            color: #ccc !important;
            cursor: not-allowed;
            box-shadow: none;
        }

        .btn-nav-text {
            padding-left: 15px !important;
            padding-right: 15px !important;
            width: auto !important;
        }

        /* ===================================== */

        /* Container Utama Search Bar (Bentuk Pil) */
        .search-pill {
            background: #ffffff;
            border-radius: 50px;
            padding: 8px 25px;
            /* Sedikit lebih compact tapi tetap lega */

            /* FIX TENGGELAM: Shadow yang lebih kuat & posisi relative */
            box-shadow: 0 10px 40px rgba(8, 31, 92, 0.1);
            /* Menggunakan hint warna --midnight */
            position: relative;
            z-index: 10;
            /* Agar selalu di atas elemen background/blob */

            display: flex;
            align-items: center;
            gap: 15px;

            /* REQUEST OUTLINE: Border default menggunakan warna china (biru muda) */
            border: 2px solid var(--porcelain);
            transition: all 0.3s ease;
        }

        /* Efek Hover & Focus: Outline berubah jadi warna Royal (Biru Gelap) */
        .search-pill:hover,
        .search-pill:focus-within {
            transform: translateY(-3px);
            border-color: var(--royal);
            /* Outline menyala */
            box-shadow: 0 15px 45px rgba(51, 78, 172, 0.2);
            /* Shadow lebih menyebar */
        }

        /* Ikon Search */
        .search-icon {
            color: var(--china);
            /* Biru muda */
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        /* Saat input diketik, ikon jadi biru tua */
        .search-pill:focus-within .search-icon {
            color: var(--royal);
        }

        /* Input Field */
        .search-input {
            border: none;
            outline: none;
            box-shadow: none;
            background: transparent;
            width: 100%;
            font-size: 1rem;
            color: var(--midnight);
            /* Teks biru sangat tua */
            font-weight: 600;
            /* Sedikit tebal agar tegas */
        }

        .search-input::placeholder {
            color: #aeb9cc;
            /* Abu-abu soft */
            font-weight: 400;
        }

        .search-input:focus {
            box-shadow: none;
            background: transparent;
        }

        /* Garis Pemisah Vertikal */
        .vertical-divider {
            width: 2px;
            height: 24px;
            background-color: var(--porcelain);
        }

        /* Tombol Filter (Icon Only) */
        .btn-filter-icon {
            background: transparent;
            border: none;
            color: var(--midnight);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-filter-icon:hover {
            background-color: var(--dawn);
            /* Biru sangat muda saat hover */
            color: var(--royal);
        }

        /* Indikator Filter Aktif (Titik Merah) */
        .btn-filter-icon.active-filter::after {
            content: '';
            position: absolute;
            top: 5px;
            right: 5px;
            width: 10px;
            height: 10px;
            background-color: #ff5b5b;
            border: 2px solid #fff;
            border-radius: 50%;
        }

        /* Dropdown Menu Custom */
        .filter-dropdown-menu {
            border: 1px solid var(--porcelain);
            box-shadow: 0 10px 30px rgba(8, 31, 92, 0.15);
            border-radius: 16px;
            padding: 10px;
            margin-top: 15px !important;
            background-color: #fff;
        }

        .filter-dropdown-item {
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--midnight);
            transition: all 0.2s;
            cursor: pointer;
        }

        .filter-dropdown-item:hover {
            background-color: var(--dawn);
            color: var(--royal);
        }

        .filter-dropdown-item.active {
            background-color: var(--royal);
            color: #fff !important;
        }
    </style>

    <div class="page-offset">
        <div class="blob-bg" style="top: 100px; right: -200px;"></div>

        <div class="container" style="padding-bottom: 60px; color: var(--asian-pear)">
            <div class="row mb-5">
                <div class="col-md-8">
                    <h2 class="display-6 fw-bold" style="color: var(--royal)">Riwayat Booking</h2>
                    <p class="" style="color: var(--midnight)">Pantau status sewa dan riwayat pembayaran Anda.</p>
                </div>
            </div>

            <div class="row justify-content-center">

                <div class="row justify-content-center mb-5">
                    <div class="col-lg-9">
                        <form action="{{ route('penyewa.riwayat') }}" method="GET" id="searchForm">
                            <input type="hidden" name="status" id="statusInput" value="{{ request('status', 'all') }}">

                            <div class="search-pill">
                                <i class="fas fa-search search-icon ms-2"></i>
                                <input type="text" name="search" class="form-control search-input"
                                    placeholder="Cari ID Booking atau No Kamar..." value="{{ request('search') }}" autocomplete="off">
                                <div class="vertical-divider"></div>
                                <div class="dropdown">
                                    <button class="btn-filter-icon {{ request('status') && request('status') != 'all' ? 'active-filter' : '' }} me-1"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Filter Status">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end filter-dropdown-menu">
                                        <li><h6 class="dropdown-header text-uppercase small fw-bold" style="color: var(--china);">Filter Status</h6></li>
                                        <li onclick="selectStatus('all')"><a class="dropdown-item filter-dropdown-item {{ request('status') == 'all' ? 'active' : '' }}">Semua Status</a></li>
                                        <li onclick="selectStatus('menunggu_pelunasan')"><a class="dropdown-item filter-dropdown-item {{ request('status') == 'menunggu_pelunasan' ? 'active' : '' }}">Aktif / DP</a></li>
                                        <li onclick="selectStatus('lunas')"><a class="dropdown-item filter-dropdown-item {{ request('status') == 'lunas' ? 'active' : '' }}">Lunas</a></li>
                                        <li onclick="selectStatus('tidak_aktif')"><a class="dropdown-item filter-dropdown-item {{ request('status') == 'tidak_aktif' ? 'active' : '' }}">Tidak Aktif</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function selectStatus(val) {
                        document.getElementById('statusInput').value = val;
                        document.getElementById('searchForm').submit();
                    }
                </script>

                 @forelse($bookings as $booking)
                    @php
                        $uiLabel = 'Menunggu Pembayaran';
                        $uiClass = 'bg-warning text-dark';
                        $isInactive = false;

                        switch($booking->status_booking) {
                            case 'menunggu_pembayaran':
                                $uiLabel = 'Menunggu Pembayaran';
                                $uiClass = 'bg-warning text-dark';
                                break;
                            case 'dp_50':
                                $uiLabel = 'Belum Lunas';
                                $uiClass = 'bg-info text-white';
                                break;
                            case 'lunas':
                                $uiLabel = 'Lunas / Aktif';
                                $uiClass = 'bg-success text-white';
                                break;
                            case 'cancel':
                                $uiLabel = 'Dibatalkan';
                                $uiClass = 'bg-danger text-white';
                                $isInactive = true;
                                break;
                            case 'selesai':
                                $uiLabel = 'Selesai';
                                $uiClass = 'bg-secondary text-white';
                                $isInactive = true;
                                break;
                        }

                        $cardClass = $isInactive ? 'card-disabled' : '';
                        $headerClass = $isInactive ? 'header-disabled' : '';
                        $collapseId = 'collapseHistory-' . $booking->id_booking;
                    @endphp

                    <div class="col-lg-10 mb-5">
                        <div class="card card-booking {{ $cardClass }}">

                            {{-- HEADER --}}
                            <div class="booking-header {{ $headerClass }} d-flex justify-content-between align-items-center">
                                <span class="badge rounded-pill {{ $uiClass }} px-3 py-2">
                                    {{ $uiLabel }}
                                </span>
                                <div class="fw-bold" style="color: var(--china); letter-spacing: 1px;">
                                    #BK-{{ $booking->id_booking }}
                                </div>
                            </div>

                            {{-- BODY --}}
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <!-- INFO KAMAR -->
                                    <div class="col-md-4">
                                        <img src="{{ Storage::disk('s3')->url($booking->kamar->foto_kamar) }}"
                                             class="img-fluid rounded-3 mb-3 shadow-sm"
                                             style="width: 100%; height: 180px; object-fit: cover;">
                                        <h5 class="fw-bold mb-1" style="color: var(--color-midnight);">
                                            Kamar {{ $booking->kamar->no_kamar }}
                                        </h5>
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-map-marker-alt me-1"></i> SiKost Area Utama
                                        </p>
                                    </div>

                                    <!-- INFO TAGIHAN -->
                                    <div class="col-md-5 border-start-md ps-md-4">
                                        <h6 class="text-uppercase text-muted small fw-bold mb-3">Rincian Sewa</h6>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Check-in</small>
                                                <span class="fw-bold text-dark">{{ $booking->tanggal_check_in->format('d M Y') }}</span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Durasi</small>
                                                <span class="fw-bold text-dark">{{ $booking->tanggal_check_in->diffInYears($booking->tanggal_check_out) }} Tahun</span>
                                            </div>
                                        </div>

                                        <!-- INFO HARGA -->
                                        <div class="mt-2 pt-2 border-top border-light">
                                            <small class="text-muted d-block mb-1">Total Harga Sewa</small>
                                            <h4 class="fw-bold text-dark mb-0">
                                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                            </h4>

                                            <!-- Info Sisa Tagihan (Jika DP) -->
                                            @if($booking->status_booking == 'dp_50')
                                                @php
                                                    $sudahBayar = $booking->pembayaran->where('status', 'verified')->sum('total_pembayaran');
                                                    $sisa = $booking->total_harga - $sudahBayar;
                                                @endphp
                                                <div class="mt-2 text-danger small fw-bold">
                                                    Sisa Tagihan: Rp {{ number_format($sisa, 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- TOMBOL AKSI (ACTION BUTTONS) -->
                                    <div class="col-md-3 text-md-end d-flex flex-column gap-3">

                                        {{-- LOGIC TOMBOL --}}
                                        @if ($booking->status_booking == 'menunggu_pembayaran')
                                            <!-- Tombol Bayar Awal -->
                                            <a href="{{ route('pembayaran.pay', $booking->id_booking) }}"
                                                class="btn btn-primary rounded-pill w-100 py-2">
                                                <i class="fas fa-wallet me-2"></i> Bayar Sekarang
                                            </a>
                                            <!-- Tombol Cancel -->
                                            <form action="{{ route('booking.update', $booking->id_booking) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="cancel">
                                                <button class="btn btn-outline-danger rounded-pill w-100 py-2 small" onclick="return confirm('Batalkan?')">
                                                    Batal
                                                </button>
                                            </form>

                                        @elseif ($booking->status_booking == 'dp_50')
                                            <!-- Tombol Pelunasan (Checkout) -->
                                            <a href="{{ route('pembayaran.pay', $booking->id_booking) }}"
                                                class="btn btn-danger btn-royal-glow rounded-pill w-100 py-2">
                                                <i class="fas fa-money-bill-wave me-2"></i> Lunasi Tagihan
                                            </a>
                                            <div class="text-center text-muted small fst-italic">
                                                Booking Aktif
                                            </div>

                                        @elseif ($booking->status_booking == 'lunas')

                                            <button disabled class="btn btn-success rounded-pill w-100 py-2 mb-2">
                                                <i class="fas fa-check-circle me-2"></i> Aktif / Lunas
                                            </button>

                                            <!-- NEW: CHECKOUT BUTTON (For Lunas users) -->
                                            <form action="{{ route('booking.update', $booking->id_booking) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="checkout">
                                                <button type="submit" class="btn btn-outline-danger rounded-pill w-100 py-2"
                                                        onclick="return confirm('Apakah Anda yakin ingin Checkout? Masa sewa Anda akan berakhir.')">
                                                    <i class="fas fa-sign-out-alt me-2"></i> Checkout Sekarang
                                                </button>
                                            </form>

                                        @else
                                            <button disabled class="btn btn-secondary rounded-pill w-100 py-2">
                                                {{ ucfirst($booking->status_booking) }}
                                            </button>
                                        @endif

                                    </div>
                                </div>

                                <div class="dashed-line"></div>

                                {{-- HISTORY LOGS --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold mb-0 small text-muted text-uppercase">
                                        <i class="fas fa-history me-2"></i> Riwayat Transaksi
                                    </h6>
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}">
                                        Detail
                                    </button>
                                </div>

                                <div class="collapse" id="{{ $collapseId }}">
                                    <div class="card card-body border-0 bg-light p-3 rounded-3">
                                        <div class="table-responsive">
                                            <table class="table table-simple table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Jenis</th>
                                                        <th>Nominal</th>
                                                        <th class="text-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($booking->pembayaran as $pembayaran)
                                                        <tr>
                                                            <td>{{ $pembayaran->created_at->format('d/m/y H:i') }}</td>
                                                            <td class="text-uppercase small fw-bold">
                                                                {{ str_replace('_', ' ', $pembayaran->jenis_pembayaran) }}
                                                            </td>
                                                            <td>Rp {{ number_format($pembayaran->total_pembayaran, 0, ',', '.') }}</td>
                                                            <td class="text-center">
                                                                @if($pembayaran->status == 'verified')
                                                                    <span class="badge bg-success">Sukses</span>
                                                                @elseif($pembayaran->status == 'pending')
                                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                                @else
                                                                    <span class="badge bg-danger">Gagal</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <h4>Belum ada riwayat booking.</h4>
                    </div>
                @endforelse

                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
