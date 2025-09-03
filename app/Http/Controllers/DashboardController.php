<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posyandu;
use App\Models\Desa;
use App\Models\Kader;
use App\Models\Gizi;





class DashboardController extends Controller
{
   public function index()
{
    
    $jumlahWasting  = Gizi::sum('jumlah_balita_wasting');
    $jumlahStunting = Gizi::sum('jumlah_balita_stunting');
    $jumlahNormal   = Gizi::sum('jumlah_balita_normal');
    $jumlahPosyandu = Posyandu::sum('jumlah_posyandu');
    $jumlahDesa     = Desa::count();
    $jumlahKader    = Posyandu::sum('jumlah_kader');

    $dataGizi = DB::table('gizi')
        ->selectRaw("DATE_FORMAT(created_at, '%M') as bulan")
        ->selectRaw("SUM(jumlah_balita_normal) as normal")
        ->selectRaw("SUM(jumlah_balita_wasting) as wasting")
        ->selectRaw("SUM(jumlah_balita_stunting) as stunting")
        ->groupBy('bulan')
        ->orderByRaw("MIN(created_at)")
        ->limit(6)
        ->get();

    // bikin total balita per bulan
    $dataGizi->map(function ($item) {
        $item->total = $item->normal + $item->wasting + $item->stunting;
        return $item;
    });

    return view('dashboard', compact(
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
