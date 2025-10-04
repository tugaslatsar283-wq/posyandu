<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeteranganBalita;
use App\Models\Gizi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeteranganBalitaController extends Controller
{
    // Tampilkan semua keterangan yang terhubung ke gizi_id tertentu
   public function index($giziId)
    {
        $gizi = Gizi::with('desa')->findOrFail($giziId);

        $data = KeteranganBalita::where('gizi_id', $giziId)->get();

        return view('keterangan_balita.index', [
            'gizi' => $gizi,
            'data' => $data,
            'gizi_id' => $giziId
        ]);
    }

    // Simpan keterangan baru (form mengirim gizi_id)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_balita' => 'required|string|max:191',
            'usia' => 'required|integer|min:0',
            'alamat' => 'required|string|max:500',
            'status' => 'required|in:Normal,Stunting,Wasting',
            'gizi_id' => 'required|exists:gizi,id',
        ]);

        // desa diambil dari user yang login supaya otomatis
        $desaId = Auth::user()->desa_id ?? null;

        KeteranganBalita::create([
            'nama_balita' => $validated['nama_balita'],
            'usia' => $validated['usia'],
            'alamat' => $validated['alamat'],
            'status' => $validated['status'],
            'gizi_id' => $validated['gizi_id'],
            'desa_id' => $desaId,
        ]);

        return redirect()->route('keterangan_balita.index', $validated['gizi_id'])
                         ->with('success', 'Keterangan balita berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $row = KeteranganBalita::findOrFail($id);
        $giziId = $row->gizi_id;
        $row->delete();

        return redirect()->route('keterangan_balita.index', $giziId)
                         ->with('success', 'Data berhasil dihapus.');
    }

    public function adminIndex($giziId, $bulan = null)
{
    $gizi = Gizi::with('desa')->findOrFail($giziId);

    $query = DB::table('keterangan_balita')
        ->join('desas', 'desas.id', '=', 'keterangan_balita.desa_id')
        ->select(
            'keterangan_balita.id',
            'keterangan_balita.gizi_id',
            'keterangan_balita.nama_balita',
            'keterangan_balita.usia',
            'keterangan_balita.alamat',
            'keterangan_balita.status',
            'desas.nama_desa'
        )
        ->where('keterangan_balita.gizi_id', $giziId);

    if ($bulan) {
        $query->whereRaw("DATE_FORMAT(keterangan_balita.created_at, '%Y-%m') = ?", [$bulan]);
    }

    $data = $query->get();

    return view('admin.keterangan', compact('data', 'gizi', 'bulan'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_balita' => 'required|string|max:255',
        'usia' => 'required|integer|min:0',
        'alamat' => 'required|string',
        'status' => 'required|in:Normal,Stunting,Wasting',
    ]);

    $balita = DB::table('keterangan_balita')->where('id', $id)->first();

    if (!$balita) {
        return redirect()->back()->with('error', 'Data balita tidak ditemukan.');
    }

    DB::table('keterangan_balita')
        ->where('id', $id)
        ->update([
            'nama_balita' => $request->nama_balita,
            'usia' => $request->usia,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

    return redirect()->back()->with('success', 'Data balita berhasil diperbarui.');
}

public function desaIndex($desaId, $bulan = null)
    {
        $query = DB::table('keterangan_balita')
            ->join('desas', 'desas.id', '=', 'keterangan_balita.desa_id')
            ->select(
                'keterangan_balita.id',
                'keterangan_balita.nama_balita',
                'keterangan_balita.usia',
                'keterangan_balita.alamat',
                'keterangan_balita.status',
                'desas.nama_desa'
            )
            ->where('keterangan_balita.desa_id', $desaId);

        if ($bulan) {
            $query->whereRaw("DATE_FORMAT(keterangan_balita.created_at, '%Y-%m') = ?", [$bulan]);
        }

        $data = $query->get();

        return view('keterangan_balita.index', compact('data', 'bulan'));
    }

    public function kecamatanIndex($giziId, $bulan = null)
{
    // Ambil data gizi berdasarkan id
    $gizi = Gizi::findOrFail($giziId);

    // Query data keterangan balita berdasarkan gizi_id
    $query = DB::table('keterangan_balita')
        ->join('desas', 'desas.id', '=', 'keterangan_balita.desa_id')
        ->select(
            'keterangan_balita.id',
            'keterangan_balita.nama_balita',
            'keterangan_balita.alamat',
            'keterangan_balita.status',
            'desas.nama_desa',
            'keterangan_balita.created_at'
        )
        ->where('keterangan_balita.gizi_id', $giziId);

    // Jika ada filter bulan
    if ($bulan) {
        $query->whereRaw("DATE_FORMAT(keterangan_balita.created_at, '%Y-%m') = ?", [$bulan]);
    }

    $data = $query->get();

    // arahkan ke view admin/keterangan.blade.php
    return view('admin.keterangan', compact('gizi', 'data', 'bulan'));
}

}

