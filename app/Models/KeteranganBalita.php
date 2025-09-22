<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganBalita extends Model
{
    use HasFactory;

    protected $table = 'keterangan_balita';

    protected $fillable = [
        'desa_id',
        'nama_balita',
        'usia',
        'alamat',
        'status',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}

