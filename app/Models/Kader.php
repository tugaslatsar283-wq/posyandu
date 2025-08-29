<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'desa_id',
        'no_hp',
    ];

    // Relasi ke Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    
}
