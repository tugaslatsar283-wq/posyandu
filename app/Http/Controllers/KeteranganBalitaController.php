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
        $gizi = Gizi::findOrFail($giziId); // kalau tidak ada 404
        // ambil semua keterangan untuk gizi ini
        $data = KeteranganBalita::where('gizi_id', $giziId)->orderBy('created_at', 'desc')->get();

        // tampilkan view dan kirim gizi & data nya
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

    public function adminIndex($desaId, $bulan = null)
    {
        $query = DB::table('keterangan_balita')
            ->join('desas', 'desas.id', '=', 'keterangan_balita.desa_id')
            ->select(
                'keterangan_balita.id',
                'keterangan_balita.gizi_id',
                'keterangan_balita.nama_balita',
                'keterangan_balita.alamat',
                'keterangan_balita.status',
                'desas.nama_desa'
            )
            ->where('keterangan_balita.desa_id', $desaId);

        if ($bulan) {
            $query->whereRaw("DATE_FORMAT(keterangan_balita.created_at, '%Y-%m') = ?", [$bulan]);
        }

        $data = $query->get();

        return view('admin.keterangan', compact('data', 'bulan'));
    }
}
