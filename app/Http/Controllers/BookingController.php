<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking untuk kamar tertentu.
     */
    public function create($id_kamar)
    {
        // Cari kamar berdasarkan id_kamar
        $kamar = Kamar::findOrFail($id_kamar);
        
        // Tampilkan view (nanti kita buat view-nya)
        return view('booking.create', compact('kamar'));
    }

    /**
     * Memproses penyimpanan data booking ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'kamar_id'          => 'required|exists:kamar,id_kamar',
            'tanggal_check_in'  => 'required|date|after_or_equal:today',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
            'tipe_pembayaran'   => 'required|string',
        ]);

        // 2. Ambil Data Kamar & User
        $kamar = Kamar::findOrFail($request->kamar_id);
        $user  = Auth::user(); // Ambil user yang sedang login

        // 3. Hitung Durasi (Malam)
        $checkIn  = Carbon::parse($request->tanggal_check_in);
        $checkOut = Carbon::parse($request->tanggal_check_out);
        $durasi   = $checkIn->diffInDays($checkOut); 

        // Minimal hitung 1 malam meski check-out di hari yang sama (opsional)
        if ($durasi < 1) $durasi = 1;

        // 4. Hitung Total Harga
        $totalHarga = $durasi * $kamar->harga;

        // 5. Simpan ke Database
        Booking::create([
            'user_id'           => $user->id,
            'kamar_id'          => $kamar->id_kamar,
            'status_booking'    => 'pending',
            'tanggal_booking'   => now(),
            'batas_booking'     => now()->addDay(), // Batas bayar 24 jam
            'tanggal_check_in'  => $request->tanggal_check_in,
            'tanggal_check_out' => $request->tanggal_check_out,
            'total_harga'       => $totalHarga,
            'tipe_pembayaran'   => $request->tipe_pembayaran,
        ]);

        // 6. Redirect ke halaman history/sukses
        return redirect()->route('booking.history')
            ->with('success', 'Booking berhasil! Silakan lakukan pembayaran.');
    }

    /**
     * Menampilkan riwayat booking milik user.
     */
    public function history()
    {
        // Ambil booking milik user yang login saja
        $bookings = Booking::with('kamar')
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('booking.history', compact('bookings'));
    }
}