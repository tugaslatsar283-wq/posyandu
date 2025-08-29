<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desa = Desa::all();
        return view('desa.index', compact('desa'));
    }

    public function create()
    {
        return view('desa.create');
    }

    public function store(Request $request)
{
    $desa = Desa::create($request->all());

    return redirect()->route('desa.index')->with('success', 'Desa berhasil ditambahkan!');
}

    public function edit(Desa $desa)
    {
        return view('desa.edit', compact('desa'));
    }

    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255|unique:desas,nama_desa,' . $desa->id,
        ]);

        $desa->update([
            'nama_desa' => $request->nama_desa,
        ]);

        return redirect()->route('desa.index')->with('success', 'Desa berhasil diperbarui');
    }

    public function destroy(Desa $desa)
    {
        $desa->delete();
        return redirect()->route('desa.index')->with('success', 'Desa berhasil dihapus');
    }
}
