<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $laporanBaru = 0;

        $bookingsPerMonth = Booking::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $bookingsPerMonth[$i] ?? 0;
        }

        $recentBookings = Booking::with(['profile', 'kamar'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'booking',
                    'title' => 'Booking Baru',
                    'desc' => $item->profile->nama_lengkap . ' membooking Kamar ' . $item->kamar->no_kamar,
                    'time' => $item->created_at,
                    'icon' => 'fas fa-user-plus',
                    'color' => 'blue'
                ];
            });

        $recentPayments = Pembayaran::with(['booking.profile'])
            ->where('status', 'verified')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'payment',
                    'title' => 'Pembayaran Diterima',
                    'desc' => 'Rp ' . number_format($item->total_pembayaran, 0, ',', '.') . ' dari ' . ($item->booking->profile->nama_lengkap ?? 'User'),
                    'time' => $item->created_at,
                    'icon' => 'fas fa-money-bill',
                    'color' => 'green'
                ];
            });

        $activities = $recentBookings->merge($recentPayments)
            ->sortByDesc('time')
            ->take(6);

        return view('admin.dashboard.index', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi',
            'laporanBaru',
            'chartData',
            'activities'
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
