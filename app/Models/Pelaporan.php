<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;

    protected $table = 'pelaporan';
    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'user_id',
        'keluhan',
        'no_kamar',
        'deskripsi_keluhan',
        'foto_bukti',
        'foto_after_perbaikan',
        'waktu_keluhan',
        'tanggal_keluhan',
        'status_admin',
        'status_ob',
    ];

    /**
     * Relasi ke tabel users
     * Setiap pelaporan dibuat oleh satu user (penyewa).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
