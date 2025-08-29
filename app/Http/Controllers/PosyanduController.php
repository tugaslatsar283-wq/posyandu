<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosyanduController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika operator, hanya lihat data desanya
        if ($user->role === 'operator') {
            $posyandus = Posyandu::where('desa_id', $user->desa_id)->get();
        } else {
            $posyandus = Posyandu::all();
        }

        return view('posyandu.index', compact('posyandus'));
    }

    public function create()
    {
        return view('posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_posyandu' => 'required|integer|min:0',
            'jumlah_balita' => 'required|integer|min:0',
            'jumlah_balita_normal' => 'required|integer|min:0',
            'jumlah_balita_stunting' => 'required|integer|min:0',
            'jumlah_balita_wasting' => 'required|integer|min:0',
            'jumlah_kader' => 'required|integer|min:0',
        ]);

        Posyandu::create([
            'desa_id' => Auth::user()->desa_id, // otomatis sesuai desa operator
            'jumlah_posyandu' => $request->jumlah_posyandu,
            'jumlah_balita' => $request->jumlah_balita,
            'jumlah_balita_normal' => $request->jumlah_balita_normal,
            'jumlah_balita_stunting' => $request->jumlah_balita_stunting,
            'jumlah_balita_wasting' => $request->jumlah_balita_wasting,
            'jumlah_kader' => $request->jumlah_kader,
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Data posyandu berhasil ditambahkan');
    }
}
