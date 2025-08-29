@extends('layouts.app')

@section('title', 'Edit Desa')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('desa.update', $desa->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama Desa</label>
                <input type="text" name="nama_desa" class="form-control" value="{{ $desa->nama_desa }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('desa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
