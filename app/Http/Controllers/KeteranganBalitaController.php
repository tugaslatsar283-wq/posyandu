<?php

namespace App\Http\Controllers;

use App\Models\KeteranganBalita;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeteranganBalitaController extends Controller
{
  public function index($gizi_id)
{
    $user = Auth::user();

    $data = KeteranganBalita::with('desa')
        ->where('desa_id', $user->desa_id)
        ->where('gizi_id', $gizi_id)
        ->get();

    $gizi = Gizi::findOrFail($gizi_id);

    return view('keterangan_balita.index', compact('data', 'gizi'));
}

    public function create()
    {
        $desas = Desa::all();
        return view('keterangan_balita.create', compact('desas'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'nama_balita' => 'required',
            'usia' => 'required|integer',
            'alamat' => 'required',
            'status' => 'required|in:Normal,Stunting,Wasting',
        ]);

        KeteranganBalita::create([
            'desa_id' => Auth::user()->desa_id,
            'nama_balita' => $request->nama_balita,
            'usia' => $request->usia,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);

        return redirect()->route('keterangan_balita.index')->with('success', 'Data berhasil ditambahkan');
    }
public function destroy($id)
    {
        $balita = KeteranganBalita::findOrFail($id);
        $balita->delete();
        return redirect()->route('keterangan_balita.index')->with('success', 'Data berhasil dihapus');
    }
}