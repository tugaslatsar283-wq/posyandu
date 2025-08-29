@extends('adminlte::page')

@section('title', 'Tambah Data Desa')

@section('content_header')
    <h1>Tambah Data Desa</h1>
@stop

@section('content')
    <form action="{{ route('data-desa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Desa</label>
            <input type="text" class="form-control" value="{{ auth()->user()->desa->nama_desa }}" readonly>
        </div>

        <div class="mb-3">
            <label>Periode</label>
            <input type="text" name="periode" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Posyandu</label>
            <input type="number" name="jumlah_posyandu" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Kader</label>
            <input type="number" name="jumlah_kader" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Balita</label>
            <input type="number" name="jumlah_balita" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Stunting</label>
            <input type="number" name="jumlah_stunting" class="form-control">
            <textarea name="keterangan_stunting" class="form-control" placeholder="Keterangan penyebab stunting"></textarea>
        </div>

        <div class="mb-3">
            <label>Jumlah Wasting</label>
            <input type="number" name="jumlah_wasting" class="form-control">
            <textarea name="keterangan_wasting" class="form-control" placeholder="Keterangan penyebab wasting"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@stop
