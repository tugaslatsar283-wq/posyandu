<?php

namespace App\Http\Controllers;

use App\Models\Gizi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiziController extends Controller
{
    // Tampilkan data gizi
    public function index()
    {
        // Ambil desa_id dari operator yang login
        $desaId = Auth::user()->desa_id;

        // Filter data gizi sesuai desa
        $dataGizi = Gizi::where('desa_id', $desaId)->get();

        return view('posyandu.index', compact('dataGizi'));
    }

    // Simpan data gizi baru
   public function store(Request $request)
{
    $request->validate([
        'jumlah_balita_normal' => 'required|integer',
        'jumlah_balita_wasting' => 'required|integer',
        'jumlah_balita_stunting' => 'required|integer',
    ]);

    Gizi::create([
        'desa_id' => auth()->user()->desa_id, // otomatis
        'jumlah_balita_normal' => $request->jumlah_balita_normal,
        'jumlah_balita_wasting' => $request->jumlah_balita_wasting,
        'jumlah_balita_stunting' => $request->jumlah_balita_stunting,
    ]);

    return redirect()->back()->with('success', 'Data gizi berhasil ditambahkan');
}

    // Hapus data gizi
    public function destroy($id)
    {
        $gizi = Gizi::findOrFail($id);

        // pastikan hanya bisa hapus data dari desa sendiri
        if ($gizi->desa_id == Auth::user()->desa_id) {
            $gizi->delete();
            return redirect()->back()->with('success', 'Data gizi berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak bisa menghapus data dari desa lain.');
    }
}
