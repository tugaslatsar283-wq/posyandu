<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'desa_id',
        'periode',
        'jumlah_posyandu',
        'jumlah_kader',
        'jumlah_balita',
        'jumlah_stunting',
        'keterangan_stunting',
        'jumlah_wasting',
        'keterangan_wasting',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
