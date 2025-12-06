<?php

namespace App\Http\Controllers\Penyewa; // Namespace disesuaikan dengan folder

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        // ==========================================
        // DUMMY DATA (Simulasi Database)
        // ==========================================
        $bookings = [
            [
                'id' => 1,
                'invoice' => '#INV-2025-001',
                'status' => 'menunggu_pelunasan', 
                'kamar' => 'Kamar Standard',
                'kost' => 'Kost Griya Cendana',
                'check_in' => '01 Nov 2025',
                'durasi' => '1 Tahun',
                'check_out' => '01 Nov 2026',
                'total_tagihan' => 'Rp 1.500.000',
                'img' => 'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?auto=format&fit=crop&w=800&q=80',
                'histori' => [
                    ['tgl' => '01 Nov 2025', 'ket' => 'Booking Fee', 'metode' => 'BCA', 'nom' => 'Rp 500.000', 'stat' => 'Lunas'],
                    // ['tgl' => '05 Nov 2025', 'ket' => 'Pelunasan 1', 'metode' => 'QRIS', 'nom' => 'Rp 1.000.000', 'stat' => 'Pending'],
                ]
            ],
            [
                'id' => 2,
                'invoice' => '#INV-2025-088',
                'status' => 'lunas',
                'kamar' => 'Kamar Executive',
                'kost' => 'Kost Sultan Agung',
                'check_in' => '15 Des 2025',
                'durasi' => '6 Bulan',
                'check_out' => '15 Jun 2026',
                'total_tagihan' => 'Rp 1.500.000',
                'img' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600',
                'histori' => [
                    ['tgl' => '15 Des 2025', 'ket' => 'Full Payment', 'metode' => 'Mandiri', 'nom' => 'Rp 1.500.000', 'stat' => 'Lunas'],
                ]
            ],
            [
                'id' => 3,
                'invoice' => '#INV-2024-021',
                'status' => 'tidak_aktif',
                'kamar' => 'Kamar Deluxe',
                'kost' => 'Kost Melati Indah',
                'check_in' => '01 Apr 2024',
                'durasi' => '1 Tahun',
                'check_out' => '01 Apr 2025',
                'total_tagihan' => 'Rp 1.500.000',
                'img' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600',
                'histori' => [
                    ['tgl' => '01 Apr 2024', 'ket' => 'Pelunasan', 'metode' => 'BCA', 'nom' => 'Rp 1.500.000', 'stat' => 'Lunas'],
                ]
            ],
        ];

        return view('penyewa.riwayat', compact('bookings'));
    }
}