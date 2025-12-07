<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Profile;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class BookingController extends Controller
{

    public function create($kamar_id)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if (!$profile) {
            return redirect()->route('profil.index')
                ->withErrors(['msg' => 'Anda harus melengkapi profil terlebih dahulu sebelum booking']);
        }

        if (empty($profile->nik) || empty($profile->foto_ktp) || empty($profile->no_hp)) {
            return redirect()->route('profil.index')
                ->withErrors(['msg' => 'Mohon lengkapi NIK, No HP, dan Foto KTP untuk verifikasi sewa']);
        }

        $kamar = Kamar::findOrFail($kamar_id);
        if ($kamar->status !== 'tersedia') {
            return back()->withErrors(['msg' => 'Kamar ini sudah tidak tersedia.']);
        }

        return view('penyewa.booking.create', compact('kamar', 'profile'));
    }

    /**
     * POST /booking
     * Membuat booking baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id_kamar',
            'tanggal_check_in' => 'required|date|after_or_equal:today',
            'durasi_tahun' => 'required|integer|min:1',
            'opsi_bayar' => 'required|in:50,100',
        ]);

        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->firstOrFail();
        $kamar = Kamar::findOrFail($request->kamar_id);

        $durasi = (int) $request->durasi_tahun;
        $totalHargaSewa = $kamar->harga * $durasi;
        $persentase = $request->opsi_bayar;
        $nominalBayar = $totalHargaSewa * ($persentase / 100);

        $checkIn = \Carbon\Carbon::parse($request->tanggal_check_in);
        $checkOut = $checkIn->copy()->addYears($durasi);

        $booking = Booking::create([
            'profile_id' => $profile->id_profile,
            'kamar_id' => $kamar->id_kamar,
            'status_booking' => 'menunggu_pembayaran',
            'total_harga' => $totalHargaSewa,
            'tanggal_booking' => now(),
            'batas_booking' => now()->addHours(24),
            'tanggal_check_in' => $checkIn,
            'tanggal_check_out' => $checkOut,
            'tipe_pembayaran' => 'tahunan'
        ]);

        $pembayaran = new Pembayaran();
        $pembayaran->booking_id = $booking->id_booking;
        $pembayaran->total_pembayaran = $nominalBayar;
        $pembayaran->jenis_pembayaran = ($persentase == 100) ? 'lunas_awal' : 'dp_awal';
        $pembayaran->status = 'pending';
        $pembayaran->metode_pembayaran = 'Midtrans';
        $pembayaran->save();

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $orderId = 'PAY-' . $pembayaran->id_pembayaran . '-' . time();
        $pembayaran->midtrans_code = $orderId;
        $pembayaran->save();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $nominalBayar,
            ],
            'customer_details' => [
                'first_name' => $profile->nama_lengkap,
                'email' => $user->email,
                'phone' => $profile->no_hp,
            ],
            'item_details' => [[
                'id' => $kamar->id_kamar,
                'price' => (int) $nominalBayar,
                'quantity' => 1,
                'name' => "Sewa Kamar {$kamar->no_kamar} ({$persentase}%)"
            ]]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return view('pembayaran.pay', [
                'snapToken' => $snapToken,
                'pembayaran' => $pembayaran,
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Midtrans Error: ' . $e->getMessage());
        }
    }

    /**
     * GET /booking
     * Menampilkan list booking saya
     */
    public function index()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if (!$profile) {
            return redirect()->route('profile.index');
        }

        $bookings = Booking::where('profile_id', $profile->id)
            ->with('kamar')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penyewa.booking.index', compact('bookings'));
    }

    /**
     * GET /booking/{id}
     * Detail Booking
     */
    public function show($id)
    {
        $booking = Booking::with('kamar')->findOrFail($id);

        $userProfileId = Auth::user()->profile->id ?? 0;
        if ($booking->profile_id !== $userProfileId) {
            abort(403, 'Unauthorized action.');
        }

        return view('penyewa.booking.show', compact('booking'));
    }

    /**
     * PATCH /booking/{id}
     * Handle Cancel or Checkout
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::with('kamar')->findOrFail($id);

        $userProfileId = Auth::user()->profile->id_profile ?? 0;
        if ($booking->profile_id !== $userProfileId) {
            abort(403, 'Unauthorized');
        }

        if ($request->action == 'cancel') {
            if ($booking->status_booking == 'menunggu_pembayaran') {
                $booking->update(['status_booking' => 'cancel']);
                return back()->with('success', 'Booking berhasil dibatalkan.');
            }
        }

        if ($request->action == 'checkout') {
            if (in_array($booking->status_booking, ['lunas', 'dp_50'])) {

                $booking->update(['status_booking' => 'selesai']);

                if ($booking->kamar) {
                    $booking->kamar->update(['status' => 'tersedia']);
                }

                return back()->with('success', 'Checkout berhasil. Terima kasih telah menyewa!');
            }
        }

        return back()->with('error', 'Aksi tidak valid untuk status booking saat ini.');
    }
}
