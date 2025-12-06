<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    // Menyesuaikan dengan tabel dari divisi lain
    protected $table = 'booking'; 
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'user_id',
        'kamar_id',
        'status_booking',
        'total_harga',
        'tanggal_booking',
        'batas_booking',
        'tanggal_check_in',
        'tanggal_check_out',
        'tipe_pembayaran',
    ];

    protected $casts = [
        'tanggal_booking'   => 'datetime',
        'batas_booking'     => 'datetime',
        'tanggal_check_in'  => 'date',
        'tanggal_check_out' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kamar(): BelongsTo
    {
        // Pastikan 'id_kamar' sesuai dengan Primary Key di tabel kamar
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id_kamar');
    }
}