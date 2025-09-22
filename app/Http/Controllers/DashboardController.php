<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posyandu;
use App\Models\Desa;
use App\Models\Kader;
use App\Models\Gizi;
use Carbon\Carbon;






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

    $bulanOptions = collect(range(0, 5))->map(function ($i) {
        return Carbon::now()->subMonths($i)->format('Y-m');
    })->reverse()->values();

    return view('dashboard', compact(
        'jumlahWasting',
        'jumlahStunting',
        'jumlahNormal',
        'jumlahPosyandu',
        'jumlahDesa',
        'jumlahKader',
        'dataGizi',
        'bulanOptions'
    ));
}

public function giziChartDataAllDesa(Request $request)
{
    $bulan = $request->get('bulan', 'all');

    $query = DB::table('gizi')
        ->join('desas', 'gizi.desa_id', '=', 'desas.id')
        ->select(
            'desas.nama_desa as desa',
            DB::raw('SUM(gizi.jumlah_balita_stunting) as stunting'),
            DB::raw('SUM(gizi.jumlah_balita_wasting) as wasting')
        )
        ->groupBy('desas.nama_desa');

    if ($bulan !== 'all') {
        // parse bulan format: YYYY-MM
        try {
            $carbonDate = \Carbon\Carbon::createFromFormat('Y-m', $bulan);
            $query->whereMonth('gizi.created_at', $carbonDate->month)
                  ->whereYear('gizi.created_at', $carbonDate->year);
        } catch (\Exception $e) {
            // kalau format salah, biarkan query tanpa filter
        }
    }

    $data = $query->get();

    return response()->json($data);
}

}
