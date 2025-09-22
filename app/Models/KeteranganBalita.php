<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganBalita extends Model
{
    use HasFactory;

    protected $table = 'keterangan_balita'; // sesuaikan nama tabel

    protected $fillable = [
        'gizi_id',
        'desa_id',
        'nama_balita',
        'usia',
        'alamat',
        'status',
    ];

    public function gizi()
    {
        return $this->belongsTo(\App\Models\Gizi::class);
    }

    public function desa()
    {
        return $this->belongsTo(\App\Models\Desa::class);
    }
}