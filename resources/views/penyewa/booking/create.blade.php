@extends('layouts.layoutPenyewa')

@section('title', 'Booking Kamar')

@section('konten')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <h2 class="fw-bold mb-5 text-center text-md-start" style="color: var(--midnight);">
                <i class="fas fa-calendar-check me-2" style="color: var(--royal);"></i>
                Konfirmasi Booking Kamar
            </h2>

            <div class="row g-5">
                <div class="col-md-5">
                    <div class="card border-0 shadow-lg h-100" style="border-radius: 20px;">
                        <div class="kos-image" style="height: 280px;">
                            <img src="{{ Storage::disk('s3')->url($kamar->foto_kamar) }}"
                                alt="Kamar {{ $kamar->no_kamar }}"
                                style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                        </div>
                        <div class="card-body p-4">
                            <h4 class="fw-bold kos-title">Kamar {{ $kamar->no_kamar }}</h4>
                            <p class="kos-location mb-3"><i class="fas fa-map-marker-alt me-2"></i>SiKos Area Utama</p>

                            <div class="bg-light p-3 rounded-3 mb-3">
                                <span class="d-block text-muted small">Harga Sewa per Tahun</span>
                                <h5 class="text-primary fw-bold mb-0" style="color: var(--royal) !important;">
                                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                </h5>
                            </div>

                            <p class="small text-muted mt-3 mb-0" style="text-align: justify;">
                                {{ $kamar->deskripsi_kamar ?? 'Fasilitas lengkap dengan AC, WiFi, dan Kamar Mandi Dalam.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="mb-4 fw-bold" style="color: var(--midnight);">Isi Data Sewa</h4>

                            <div class="alert mb-4 p-3" role="alert"
                                style="background-color: var(--dawn); border-left: 5px solid var(--royal);">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-user-check me-3 fs-3" style="color: var(--royal);"></i>
                                    <div>
                                        <small class="d-block fw-bold" style="color: var(--midnight);">Data Penyewa
                                            Terverifikasi</small>
                                        <small style="color: var(--royal);">{{ $profile->nama_lengkap }} (NIK:
                                            {{ $profile->nik }})</small>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="kamar_id" value="{{ $kamar->id_kamar }}">

                                <div class="mb-4">
                                    <label class="form-label fw-bold" style="color: var(--royal);">Mulai Tanggal
                                        Berapa?</label>
                                    <input type="date" name="tanggal_check_in"
                                        class="form-control form-control-lg search-box-input" required
                                        min="{{ date('Y-m-d') }}" style="border-radius: 10px; border-width: 2px;">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" style="color: var(--royal);">Durasi Sewa
                                        (Tahun)</label>
                                    <select name="durasi_tahun" id="durasi"
                                        class="form-select form-select-lg search-box-input"
                                        style="border-radius: 10px; border-width: 2px;">
                                        <option value="1">1 Tahun</option>
                                        <option value="2">2 Tahun</option>
                                        <option value="3">3 Tahun</option>
                                    </select>
                                </div>

                                <div class="bg-porcelain p-4 rounded-3 mb-4"
                                    style="background-color: var(--porcelain);">
                                    <h5 class="fw-bold mb-3" style="color: var(--midnight);">Ringkasan Pembayaran</h5>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span style="color: var(--royal);">Total Harga Sewa (<span
                                                id="durasi-tahun-display">1</span> Tahun)</span>
                                        <span id="harga-display" class="fw-bold" style="color: var(--midnight);">Rp
                                            {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <hr class="my-3" style="border-color: rgba(51, 78, 172, 0.3);">
                                    <div class="d-flex justify-content-between fw-bold fs-5"
                                        style="color: var(--royal);">
                                        <span>TOTAL BAYAR AWAL</span>
                                        <span id="total-display">Rp
                                            {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label class="form-label fw-bold" style="color: var(--royal);">Pilih Opsi Pembayaran
                                        Awal</label>
                                    <div class="card p-3 border-0"
                                        style="background-color: var(--asian-pear); border-radius: 10px;">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="opsi_bayar"
                                                id="bayar_full" value="100" checked
                                                style="border-color: var(--royal); transform: scale(1.2);">
                                            <label class="form-check-label fw-bold ms-2" for="bayar_full"
                                                style="color: var(--midnight);">
                                                Bayar Lunas (100%)
                                            </label>
                                            <div class="text-muted small ms-4">Lunyasi seluruh masa sewa sekarang: <span
                                                    id="full-payment-amount" class="fw-bold"
                                                    style="color: var(--royal);"></span></div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="opsi_bayar" id="bayar_dp"
                                                value="50" style="border-color: var(--royal); transform: scale(1.2);">
                                            <label class="form-check-label fw-bold ms-2" for="bayar_dp"
                                                style="color: var(--midnight);">
                                                Down Payment (50%)
                                            </label>
                                            <div class="text-muted small ms-4">Bayar setengah dulu, sisanya saat
                                                check-in: <span id="dp-amount" class="fw-bold"
                                                    style="color: var(--royal);"></span></div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary-custom w-100 py-3 fw-bold rounded-pill">
                                    Lanjut ke Pembayaran <i class="fas fa-arrow-right ms-2"></i>
                                </button>

                                <a href="{{ route('kamar.index') }}" class="btn btn-danger w-100 mt-3 rounded-pill"
                                    style="color: white;">
                                    Batal dan Kembali
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // FIX SINTAKS BLADE: Mengambil harga kamar dengan benar dari PHP
    const hargaPerTahun = {{ $kamar->harga }};
    const selectDurasi = document.getElementById('durasi');
    const totalDisplay = document.getElementById('total-display');
    const radioFull = document.getElementById('bayar_full');
    const radioDp = document.getElementById('bayar_dp');
    const hargaDisplay = document.getElementById('harga-display');
    const durasiTahunDisplay = document.getElementById('durasi-tahun-display');
    const fullPaymentAmount = document.getElementById('full-payment-amount');
    const dpAmount = document.getElementById('dp-amount');

    // Fungsi format mata uang
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0, // Hilangkan ,00
            maximumFractionDigits: 0
        }).format(number);
    }

    function calculateTotal() {
        let tahun = parseInt(selectDurasi.value);
        let totalAsli = hargaPerTahun * tahun;

        let totalFullPayment = totalAsli;
        let totalDpPayment = totalAsli * 0.5;

        // Tentukan jumlah bayar awal berdasarkan radio button yang dicek
        let totalBayarAwal = radioFull.checked ? totalFullPayment : totalDpPayment;

        // Update teks display
        durasiTahunDisplay.innerText = tahun;
        hargaDisplay.innerText = formatRupiah(totalAsli);
        totalDisplay.innerText = formatRupiah(totalBayarAwal);

        // Update teks pada opsi pembayaran
        fullPaymentAmount.innerText = formatRupiah(totalFullPayment);
        dpAmount.innerText = formatRupiah(totalDpPayment);
    }

    // Listener
    selectDurasi.addEventListener('change', calculateTotal);
    radioFull.addEventListener('change', calculateTotal);
    radioDp.addEventListener('change', calculateTotal);

    // Panggil saat halaman dimuat
    calculateTotal();
</script>
@endsection