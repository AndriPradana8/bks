<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabahs'; // Optional, but good to be explicit since class name might have been lowercase

    protected $fillable = [
        'user_id',
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'no_hp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
