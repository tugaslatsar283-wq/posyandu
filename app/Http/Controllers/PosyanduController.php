<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Posyandu;
use App\Models\Gizi;

class PosyanduController extends Controller
{
    public function index()
    {
        // Ambil desa_id dari user yang login
        $desaId = Auth::user()->desa_id;

        // Filter data sesuai desa_id
        $dataPosyandu = Posyandu::where('desa_id', $desaId)->get();
        $dataGizi     = Gizi::where('desa_id', $desaId)->get();

        return view('posyandu.index', compact('dataPosyandu', 'dataGizi'));
    }

    public function store(Request $request)
    {
        Posyandu::create([
            'desa_id' => Auth::user()->desa_id,
            'jumlah_posyandu' => $request->jumlah_posyandu,
            'jumlah_kader'    => $request->jumlah_kader,
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $posyandu = Posyandu::findOrFail($id);
        $posyandu->delete();

        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu berhasil dihapus!');
    }
}
