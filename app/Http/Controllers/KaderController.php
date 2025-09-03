<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPosyandu; // kalau tabelnya khusus untuk posyandu & kader

class KaderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah_posyandu' => 'required|integer|min:0',
            'jumlah_kader'    => 'required|integer|min:0',
        ]);

        MasterPosyandu::create($validated);

        return back()->with('success', 'Data kader & posyandu berhasil disimpan');
    }
}
