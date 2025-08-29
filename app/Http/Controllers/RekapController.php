<?php

namespace App\Http\Controllers;

use App\Models\DataDesa;
use App\Models\Desa;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index()
    {
        // Ambil semua data per desa (rekap terbaru)
        $rekap = Desa::with(['dataDesa' => function($q) {
            $q->latest()->take(1); // hanya ambil data terakhir tiap desa
        }])->get();

        return view('rekap.index', compact('rekap'));
    }
}
