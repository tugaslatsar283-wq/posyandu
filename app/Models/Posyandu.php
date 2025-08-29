<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $fillable = [
        'desa_id',
        'jumlah_posyandu',
        'jumlah_balita',
        'jumlah_balita_normal',
        'jumlah_balita_stunting',
        'jumlah_balita_wasting',
        'jumlah_kader',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
