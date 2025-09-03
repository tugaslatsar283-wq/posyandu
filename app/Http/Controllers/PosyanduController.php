<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Desa;
use App\Models\Gizi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosyanduController extends Controller
{
    /**
     * Tampilkan daftar posyandu
     */
    public function index()
{
    $dataPosyandu = Posyandu::all();
    $dataGizi     = Gizi::with('desa')->get();

    return view('posyandu.index', compact('dataPosyandu', 'dataGizi'));
}

    /**
     * Simpan data baru
     */
    public function store(Request $request)
{
    $request->validate([
        'jumlah_posyandu' => 'required|integer',
        'jumlah_kader' => 'required|integer',
    ]);

    Posyandu::create([
        'desa_id' => auth()->user()->desa_id, // otomatis ambil dari user
        'jumlah_posyandu' => $request->jumlah_posyandu,
        'jumlah_kader' => $request->jumlah_kader,
    ]);

    return redirect()->back()->with('success', 'Data posyandu berhasil ditambahkan');
}
    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $posyandu = Posyandu::findOrFail($id);
        $posyandu->delete();

        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu berhasil dihapus.');
    }
}
