<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        // ambil semua user beserta desa
        $users = User::with('desa')->latest()->get();

        // ambil semua desa (tanpa filter)
        $desas = Desa::orderBy('nama_desa')->get();

        return view('users.index', compact('users', 'desas'));
    }

    /**
     * Tampilkan form create (opsional kalau pakai modal bisa di-skip)
     */
    public function create()
    {
        $desas = Desa::orderBy('nama_desa')->get();
        return view('users.create', compact('desas'));
    }

    /**
     * Simpan user baru
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required',
        'desa_id' => 'nullable|exists:desas,id',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role' => $request->role,
        'desa_id' => $request->desa_id, // langsung simpan
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
}


    /**
     * Edit user
     */
    public function edit(User $user)
    {
        $desas = Desa::orderBy('nama_desa')->get();
        return view('users.edit', compact('user', 'desas'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,operator',
            'desa_id'  => 'nullable|exists:desas,id',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'desa_id'  => $request->desa_id, // ✅ langsung simpan
        ];

        // kalau password diisi → update juga
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
