<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator; // Wajib import ini untuk pagination manual
use Illuminate\Pagination\Paginator; // Wajib import ini
use Illuminate\Support\Collection; // Untuk manipulasi array

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // ==========================================
        // 1. DUMMY DATA (Raw Array)
        // ==========================================
        $rawData = [
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
             // ... Tambahkan data dummy lainnya jika ingin test pagination (misal sampai 6 data)
        ];

        // ==========================================
        // 2. KONVERSI KE COLLECTION
        // ==========================================
        // Kita ubah array biasa menjadi Collection agar bisa difilter dengan mudah
        $bookingsCollection = collect($rawData);

        // ==========================================
        // 3. LOGIC FILTER & SEARCH (Manual)
        // ==========================================
        
        // Filter berdasarkan Status
        if ($request->has('status') && $request->status != 'all') {
            $bookingsCollection = $bookingsCollection->filter(function ($item) use ($request) {
                return $item['status'] == $request->status;
            });
        }

        // Filter berdasarkan Search (Invoice / Kamar / Kost)
        if ($request->has('search') && $request->search != null) {
            $search = strtolower($request->search); // Ubah ke huruf kecil biar case-insensitive
            
            $bookingsCollection = $bookingsCollection->filter(function ($item) use ($search) {
                // Cek apakah search ada di invoice, kamar, atau kost
                return str_contains(strtolower($item['invoice']), $search) || 
                       str_contains(strtolower($item['kamar']), $search) ||
                       str_contains(strtolower($item['kost']), $search);
            });
        }

        // ==========================================
        // 4. LOGIC PAGINATION (Manual)
        // ==========================================
        
        $perPage = 5; // Batas item per halaman
        $currentPage = Paginator::resolveCurrentPage() ?: 1; // Halaman saat ini
        
        // Potong collection sesuai halaman (Slice data)
        $currentPageItems = $bookingsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        // Buat Object Paginator secara manual
        $bookings = new LengthAwarePaginator(
            $currentPageItems, // Item yang ditampilkan di halaman ini
            $bookingsCollection->count(), // Total item setelah difilter
            $perPage, // Item per halaman
            $currentPage, // Nomor halaman saat ini
            [
                'path' => Paginator::resolveCurrentPath(), // URL dasar
                'query' => $request->query(), // Agar parameter search & status tidak hilang saat ganti halaman
            ]
        );

        // Ubah array item menjadi object (agar di view bisa pakai $booking->invoice, bukan $booking['invoice'])
        // Ini opsional, tapi disarankan agar konsisten dengan Eloquent nanti
        $bookings->setCollection($currentPageItems->map(function($item) {
            return (object) $item;
        }));

        return view('penyewa.riwayat', compact('bookings'));
    }
}