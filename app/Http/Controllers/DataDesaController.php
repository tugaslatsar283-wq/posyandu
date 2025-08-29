<?php

namespace App\Http\Controllers;

use App\Models\DataDesa;
use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    public function index()
    {
        $dataDesa = DataDesa::where('desa_id', auth()->user()->desa_id)->get();
        return view('data_desa.index', compact('dataDesa'));
    }

    public function create()
    {
        return view('data_desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode' => 'required|string|max:20',
            'jumlah_posyandu' => 'nullable|integer',
            'jumlah_kader' => 'nullable|integer',
            'jumlah_balita' => 'nullable|integer',
            'jumlah_stunting' => 'nullable|integer',
            'keterangan_stunting' => 'nullable|string',
            'jumlah_wasting' => 'nullable|integer',
            'keterangan_wasting' => 'nullable|string',
        ]);

        DataDesa::create([
            'desa_id' => auth()->user()->desa_id, // otomatis ambil dari operator
            'periode' => $request->periode,
            'jumlah_posyandu' => $request->jumlah_posyandu,
            'jumlah_kader' => $request->jumlah_kader,
            'jumlah_balita' => $request->jumlah_balita,
            'jumlah_stunting' => $request->jumlah_stunting,
            'keterangan_stunting' => $request->keterangan_stunting,
            'jumlah_wasting' => $request->jumlah_wasting,
            'keterangan_wasting' => $request->keterangan_wasting,
        ]);

        return redirect()->route('data-desa.index')->with('success', 'Data berhasil ditambahkan');
    }
}
