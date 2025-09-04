<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Desa;
use App\Models\Posyandu;
use App\Models\Gizi;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ringkasan Data
        $jumlahDesa     = Desa::count();
        $jumlahPosyandu = Posyandu::sum('jumlah_posyandu');
        $jumlahKader    = Posyandu::sum('jumlah_kader');
        $jumlahBalita   = Gizi::sum(DB::raw('jumlah_balita_normal + jumlah_balita_wasting + jumlah_balita_stunting'));

        // Data Grafik Stacked Bar (status gizi per desa)
        $giziPerDesa = Desa::select(
                'desas.nama_desa as nama_desa',
                DB::raw('SUM(gizi.jumlah_balita_normal) as normal'),
                DB::raw('SUM(gizi.jumlah_balita_wasting) as wasting'),
                DB::raw('SUM(gizi.jumlah_balita_stunting) as stunting')
            )
            ->leftJoin('gizi', 'desas.id', '=', 'gizi.desa_id')
            ->groupBy('desas.id', 'desas.nama_desa')
            ->get();

        // Data Grafik Line (tren jumlah balita 6 bulan terakhir)
        $trenBalita = Gizi::selectRaw("DATE_FORMAT(created_at, '%M') as bulan")
            ->selectRaw("SUM(jumlah_balita_normal + jumlah_balita_wasting + jumlah_balita_stunting) as total")
            ->groupBy('bulan')
            ->orderByRaw("MIN(created_at)")
            ->limit(6)
            ->get();

        // Rekap Tabel per Desa
        $rekapPerDesa = Desa::select(
                'desas.nama_desa as nama_desa',
                DB::raw('COALESCE(SUM(posyandus.jumlah_posyandu),0) as jumlah_posyandu'),
                DB::raw('COALESCE(SUM(posyandus.jumlah_kader),0) as jumlah_kader'),
                DB::raw('COALESCE(SUM(gizi.jumlah_balita_normal),0) as normal'),
                DB::raw('COALESCE(SUM(gizi.jumlah_balita_wasting),0) as wasting'),
                DB::raw('COALESCE(SUM(gizi.jumlah_balita_stunting),0) as stunting')
            )
            ->leftJoin('posyandus', 'desas.id', '=', 'posyandus.desa_id')
            ->leftJoin('gizi', 'desas.id', '=', 'gizi.desa_id')
            ->groupBy('desas.id', 'desas.nama_desa')
            ->get();

            // Ambil bulan dari filter (default: bulan sekarang)
     $bulan = $request->input('bulan', now()->format('Y-m'));

    $rekap = DB::table('desas')
        ->leftJoin('posyandus', 'desas.id', '=', 'posyandus.desa_id')
        ->leftJoin('gizi', 'desas.id', '=', 'gizi.desa_id')
        ->select(
            'desas.nama_desa',
            DB::raw('COUNT(DISTINCT posyandus.id) as jumlah_posyandu'),
            DB::raw('SUM(posyandus.jumlah_kader) as jumlah_kader'),
            DB::raw('SUM(gizi.jumlah_balita_normal) as balita_normal'),
            DB::raw('SUM(gizi.jumlah_balita_wasting) as wasting'),
            DB::raw('SUM(gizi.jumlah_balita_stunting) as stunting'),
            DB::raw('(SUM(gizi.jumlah_balita_normal) + SUM(gizi.jumlah_balita_wasting) + SUM(gizi.jumlah_balita_stunting)) as total_balita')
        )
        ->whereRaw("DATE_FORMAT(gizi.created_at, '%Y-%m') = ?", [$bulan])
        ->groupBy('desas.id', 'desas.nama_desa')
        ->get();

        return view('admin.dashboard', compact(
            'jumlahDesa',
            'jumlahPosyandu',
            'jumlahKader',
            'jumlahBalita',
            'giziPerDesa',
            'trenBalita',
            'rekapPerDesa',
            'rekap',
            'bulan'
        ));
    }
}
