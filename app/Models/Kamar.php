<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    protected $guarded = ['id_kamar'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'kamar_id', 'id_kamar');
    }

    public function getHargaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'tersedia' => 'success',
            'penuh' => 'danger',
            'maintenance' => 'warning',
            default => 'secondary',
        };
    }
}