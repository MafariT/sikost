<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Pelaporan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarTerisi = $totalKamar - $kamarTersedia;
        $persentaseHunian = $totalKamar > 0 ? ($kamarTerisi / $totalKamar) * 100 : 0;

        $daftarKamar = Kamar::with(['bookings' => function($q) {
                $q->whereIn('status_booking', ['lunas', 'dp_50', 'menunggu_pembayaran'])
                  ->orderBy('created_at', 'desc');
            }, 'bookings.profile'])
            ->orderBy('no_kamar', 'asc')
            ->get();

        $riwayatPembayaran = Pembayaran::with(['booking.profile', 'booking.kamar'])
            ->latest()
            ->take(5)
            ->get();

        $pendingPembayaran = Pembayaran::where('status', 'pending')->count();
        $totalPendapatan = Pembayaran::where('status', 'verified')->sum('total_pembayaran');

        $daftarKeluhan = Pelaporan::with(['user.profile'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $keluhanProses = Pelaporan::where('status_admin', 'pending')
            ->orWhere(function($q) {
                $q->where('status_admin', 'verified')
                  ->where('status_ob', '!=', 'selesai');
            })->count();

        return view('pemilik.dashboard.index', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi',
            'persentaseHunian',
            'daftarKamar',
            'riwayatPembayaran',
            'pendingPembayaran',
            'totalPendapatan',
            'daftarKeluhan',
            'keluhanProses'
        ));
    }
}
