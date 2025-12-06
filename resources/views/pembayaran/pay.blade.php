@extends('layouts.layoutPenyewa')

@section('title', 'Selesaikan Pembayaran')

@section('konten')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<div class="container py-5" style="margin-top: 90px">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-4 p-md-5 text-center">
                    
                    <div class="mb-4">
                        <i class="fas fa-money-check-alt fa-3x" style="color: var(--royal); text-shadow: 0 0 10px rgba(51, 78, 172, 0.4);"></i>
                    </div>

                    <h2 class="fw-bold mb-2" style="color: var(--midnight);">
                        <span style="border-bottom: 3px solid var(--royal);">Checkout</span> Pembayaran
                    </h2>
                    <p class="text-muted mb-4 small">
                        Booking ID: <span class="fw-bold" style="color: var(--royal);">#{{ $booking->id_booking }}</span>
                    </p>

                    <div class="p-4 rounded-3 mb-5" style="background-color: var(--porcelain);">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold" style="color: var(--midnight);">Total Pembayaran</span>
                            <span class="fw-bold fs-3" style="color: var(--royal);">
                                Rp {{ number_format($pembayaran->total_pembayaran, 0, ',', '.') }}
                            </span>
                        </div>
                        <hr style="border-color: rgba(51, 78, 172, 0.3);">
                        <div class="d-flex justify-content-between small">
                            <span style="color: var(--china);">Jenis Transaksi Awal</span>
                            <span class="fw-bold text-uppercase" style="color: var(--royal);">{{ str_replace('_', ' ', $pembayaran->jenis_pembayaran) }}</span>
                        </div>
                    </div>

                    <button id="pay-button" class="btn btn-primary-custom w-100 py-3 fw-bold">
                        <i class="fas fa-lock me-2"></i> Lanjutkan ke Pembayaran Aman
                    </button>
                    
                    <p class="mt-4 small" style="color: var(--china);">
                        Pembayaran akan diproses melalui Midtrans. Anda akan diarahkan ke halaman pembayaran yang aman.
                    </p>
                    <a href="{{ route('booking.index') }}" class="mt-2 small text-decoration-none" style="color: var(--midnight);">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    
    payButton.addEventListener('click', function () {
        // Tampilkan loading state atau disable tombol jika perlu
        payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...';
        payButton.disabled = true;

        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran Berhasil!");
                window.location.href = "{{ route('booking.index') }}";
            },
            onPending: function(result){
                alert("Menunggu Pembayaran...");
                window.location.href = "{{ route('booking.index') }}";
            },
            onError: function(result){
                alert("Pembayaran Gagal! Silakan coba lagi.");
                // Kembalikan tombol ke kondisi semula
                payButton.innerHTML = '<i class="fas fa-lock me-2"></i> Lanjutkan ke Pembayaran Aman';
                payButton.disabled = false;
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran. Silakan coba lagi.');
                // Kembalikan tombol ke kondisi semula
                payButton.innerHTML = '<i class="fas fa-lock me-2"></i> Lanjutkan ke Pembayaran Aman';
                payButton.disabled = false;
            }
        });
    });

    // Optional: Auto trigger click
    // payButton.click();
</script>
@endsection