<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Ambil semua user untuk ditampilkan
        $users = User::all();
        return view('superadmin.index', compact('users'));
    }
}
