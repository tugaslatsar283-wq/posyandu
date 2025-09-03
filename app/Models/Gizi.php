<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gizi extends Model
{
    use HasFactory;

    protected $table = 'gizi';

    protected $fillable = [
        'desa_id',
        'jumlah_balita_normal',
        'jumlah_balita_wasting',
        'jumlah_balita_stunting',
    ];

    // Gizi.php
public function desa()
{
    return $this->belongsTo(Desa::class, 'desa_id');
}
}