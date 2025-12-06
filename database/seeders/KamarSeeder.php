<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kamar; // Import Model Kamar

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kita kosongkan dulu tabel kamar biar tidak duplikat saat dijalankan ulang
        // DB::table('kamar')->truncate(); // Opsional, hati-hati kalau di production

        $kamar = [
            [
                'no_kamar' => '101',
                'deskripsi_kamar' => 'Kamar Standard dengan Kipas Angin dan Kasur Single.',
                'harga' => 100000,
                'status' => 'tersedia',
                'foto_kamar' => null, // Foto kosong dulu
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kamar' => '102',
                'deskripsi_kamar' => 'Kamar Standard AC dengan Kasur Single yang nyaman.',
                'harga' => 150000,
                'status' => 'tersedia',
                'foto_kamar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kamar' => '201',
                'deskripsi_kamar' => 'Kamar Deluxe AC dengan Kasur Queen Size + TV.',
                'harga' => 250000,
                'status' => 'tersedia',
                'foto_kamar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kamar' => '202',
                'deskripsi_kamar' => 'Kamar Deluxe AC (View Taman) + WiFi Kencang.',
                'harga' => 275000,
                'status' => 'tersedia',
                'foto_kamar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kamar' => '301',
                'deskripsi_kamar' => 'Kamar VIP Luas + Bathtub + Include Sarapan.',
                'harga' => 400000,
                'status' => 'tersedia',
                'foto_kamar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Masukkan data ke database
        Kamar::insert($kamar);
    }
}