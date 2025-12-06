<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    use HasFactory;

    // 1. Definisi Nama Tabel (Non-standar)
    protected $table = 'kamar';

    // 2. Definisi Primary Key (Non-standar)
    protected $primaryKey = 'id_kamar';

    // 3. Kolom yang boleh diisi
    protected $fillable = [
        'no_kamar',
        'foto_kamar',
        'deskripsi_kamar',
        'harga',
        'status', // tersedia/penuh/maintenance
    ];

    // 4. Relasi: Satu Kamar bisa ada di banyak Booking (History)
    public function bookings(): HasMany
    {
        // (Model, Foreign Key di tabel sebelah, Local Key di sini)
        return $this->hasMany(Booking::class, 'kamar_id', 'id_kamar');
    }
}