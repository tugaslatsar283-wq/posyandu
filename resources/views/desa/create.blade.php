@extends('layouts.app')

@section('title', 'Tambah Desa')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('desa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Desa</label>
                <input type="text" name="nama_desa" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('desa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
