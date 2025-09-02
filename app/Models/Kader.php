<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional, hanya kalau tabel bukan 'kaders')
     */
    protected $table = 'kaders'; // ubah ke 'kader' kalau nama tabel di DB singular

    /**
     * Kolom yang bisa diisi (mass assignable)
     */
    protected $fillable = [
        'nama',
        'desa_id',
        'no_hp',
    ];

    /**
     * Relasi ke Desa
     * 1 Kader berada di 1 Desa
     */
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Scope untuk pencarian nama kader
     */
    public function scopeCariNama($query, $nama)
    {
        return $query->where('nama', 'like', "%$nama%");
    }

    /**
     * Accessor contoh (ubah huruf pertama nama jadi kapital semua kata)
     */
    public function getNamaAttribute($value)
    {
        return ucwords($value);
    }
}
