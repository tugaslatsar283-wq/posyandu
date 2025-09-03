<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ...
class Desa extends Model
{
    use HasFactory;

    protected $fillable = ['nama_desa'];

    // relasi ke users (umum)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // relasi khusus operator (satu desa maksimal satu operator)
    public function operator()
    {
        return $this->hasOne(User::class)->where('role', 'operator');
    }
    public function gizi()
{
    return $this->hasMany(Gizi::class);
}
}
