<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posyandu;
use App\Models\Desa;
use App\Models\Kader;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBalita   = Posyandu::sum('jumlah_balita');
        $jumlahWasting  = Posyandu::sum('jumlah_balita_wasting');
        $jumlahStunting = Posyandu::sum('jumlah_balita_stunting');
        $jumlahNormal   = Posyandu::sum('jumlah_balita_normal');
        $jumlahPosyandu = Posyandu::count();
        $jumlahDesa     = Desa::count();
        $jumlahKader    = Kader::count();

        return view('dashboard', compact(
            'jumlahBalita',
            'jumlahWasting',
            'jumlahStunting',
            'jumlahNormal',
            'jumlahPosyandu',
            'jumlahDesa',
            'jumlahKader'
        ));
    }
}
