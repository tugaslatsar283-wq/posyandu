<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBalita extends Model
{
    use HasFactory;

    protected $fillable = [
        'posyandu_id',
        'total_balita',
        'wasting',
        'stunting'
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }
}
