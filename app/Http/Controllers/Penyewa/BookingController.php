<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * POST /booking
     * Membuat booking baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if (!$profile || !$profile->nik) {
            return redirect()->route('profile.index')
                ->withErrors(['msg' => 'Harap lengkapi Data Diri dan NIK sebelum melakukan booking.']);
        }

        $request->validate([
            'kamar_id' => 'required|exists:kamar,id_kamar',
            'tanggal_check_in' => 'required|date|after_or_equal:today',
            'durasi_tahun' => 'required|integer|min:1',
        ]);

        $kamar = Kamar::findOrFail($request->kamar_id);

        if ($kamar->status !== 'tersedia') {
            return back()->withErrors(['msg' => 'Maaf, kamar ini sudah tidak tersedia.']);
        }

        $checkIn = Carbon::parse($request->tanggal_check_in);
        $durasi = $request->durasi_tahun;
        $checkOut = $checkIn->copy()->addYears($durasi);
        $totalHarga = $kamar->harga * $durasi;

        $booking = Booking::create([
            'profile_id' => $profile->id,
            'kamar_id' => $kamar->id_kamar,
            'status_booking' => 'menunggu_pembayaran',
            'total_harga' => $totalHarga,
            'tanggal_booking' => now(),
            'batas_booking' => now()->addHours(24),
            'tanggal_check_in' => $checkIn,
            'tanggal_check_out' => $checkOut,
            'tipe_pembayaran' => 'tahunan'
        ]);



        return redirect()->route('booking.show', $booking->id_booking)
            ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * GET /booking
     * Menampilkan list booking saya
     */
    public function index()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if(!$profile) {
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
     * Cancel booking atau update manual (jika diperlukan)
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $userProfileId = Auth::user()->profile->id ?? 0;
        if ($booking->profile_id !== $userProfileId) {
            abort(403);
        }

        if ($request->has('action') && $request->action == 'cancel') {
            $booking->update(['status_booking' => 'cancel']);
            return back()->with('success', 'Booking berhasil dibatalkan.');
        }

        return back();
    }
}