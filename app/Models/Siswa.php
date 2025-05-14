<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'foto', 'status_lapor_pkl', 'is_approved'
    ];

    public function pkl(): HasOne
    {
        return $this->hasOne(Pkl::class);
    }
}
