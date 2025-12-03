<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $primaryKey = 'id_profile';
    public $incrementing = true;
    protected $keyType = 'int';

    // Karena tabelmu pakai created_at/updated_at tapi mungkin tidak auto dari Laravel
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'tempat_tanggal_lahir',
        'foto_profile',
        'foto_ktp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
