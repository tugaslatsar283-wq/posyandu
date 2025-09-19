<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gizi;

class GiziController extends Controller
{
    public function store(Request $request)
    {
        Gizi::create([
            'desa_id' => Auth::user()->desa_id,
            'jumlah_balita_normal'   => $request->jumlah_balita_normal,
            'jumlah_balita_wasting'  => $request->jumlah_balita_wasting,
            'jumlah_balita_stunting' => $request->jumlah_balita_stunting,
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Data Gizi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $gizi = Gizi::findOrFail($id);
        $gizi->delete();

        return redirect()->route('posyandu.index')->with('success', 'Data Gizi berhasil dihapus!');
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'jumlah_balita_normal' => 'required|integer|min:0',
        'jumlah_balita_wasting' => 'required|integer|min:0',
        'jumlah_balita_stunting' => 'required|integer|min:0',
    ]);

    $gizi = Gizi::findOrFail($id);
    $gizi->update($request->only([
        'jumlah_balita_normal',
        'jumlah_balita_wasting',
        'jumlah_balita_stunting'
    ]));

    return redirect()->back()->with('success', 'Data gizi berhasil diperbarui');
}
}
