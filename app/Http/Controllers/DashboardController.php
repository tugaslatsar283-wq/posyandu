<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $jumlahPosyandu = Posyandu::sum('jumlah_posyandu');
        $jumlahDesa     = Desa::count();
        $jumlahKader    = Posyandu::sum('jumlah_kader');

         $dataGizi = DB::table('posyandus')
        ->selectRaw("DATE_FORMAT(created_at, '%M') as bulan")
        ->selectRaw("SUM(jumlah_balita_normal) as normal")
        ->selectRaw("SUM(jumlah_balita_wasting) as wasting")
        ->selectRaw("SUM(jumlah_balita_stunting) as stunting")
        ->groupBy('bulan')
        ->orderByRaw("MIN(created_at)")
        ->limit(6)
        ->get();

        return view('dashboard', compact(
            'jumlahBalita',
            'jumlahWasting',
            'jumlahStunting',
            'jumlahNormal',
            'jumlahPosyandu',
            'jumlahDesa',
            'jumlahKader',
            'dataGizi'
        ));
    }
}
