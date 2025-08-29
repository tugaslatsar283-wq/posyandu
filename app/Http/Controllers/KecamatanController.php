<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        // Logika rekap kecamatan (sementara dummy)
        return view('kecamatan.index');
    }
}
