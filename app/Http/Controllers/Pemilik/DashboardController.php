<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $daftarKeluhan = [];
        $keluhanProses = 0;

        return view('pemilik.dashboard.index', compact(
            'totalKamar', 'kamarTersedia', 'kamarTerisi', 'persentaseHunian',
            'daftarKamar', 'riwayatPembayaran', 'pendingPembayaran',
            'totalPendapatan', 'daftarKeluhan', 'keluhanProses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
