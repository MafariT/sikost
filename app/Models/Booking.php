<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'profile_id',
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

    /**
     * Relasi ke Profile (Penyewa)
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id_profile');
    }

    /**
     * Relasi ke Kamar
     */
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id_kamar');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'booking_id', 'id_booking');
    }
}
