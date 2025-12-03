<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    
    protected $guarded = ['id_pembayaran'];

    protected $casts = [
        'tenggat_penyewaan' => 'date',
        'total_pembayaran' => 'integer',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id_booking');
    }

    public function getTotalRupiahAttribute()
    {
        return 'Rp ' . number_format($this->total_pembayaran, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'verified' => 'success',
            'pending' => 'warning',
            'failed' => 'danger',
            default => 'secondary',
        };
    }
}