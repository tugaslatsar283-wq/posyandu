@extends('adminlte::page')

@section('title', 'Edit Laporan Desa')

@section('content_header')
    <h1>Edit Laporan Desa</h1>
@stop

@section('content')
    <form action="{{ route('data-desa.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Desa</label>
            <select name="desa_id" class="form-control" required>
                @foreach($desa as $d)
                    <option value="{{ $d->id }}" {{ $d->id == $data->desa_id ? 'selected' : '' }}>
                        {{ $d->nama_desa }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Periode</label>
            <input type="text" name="periode" class="form-control" value="{{ $data->periode }}" required>
        </div>
        <div class="form-group">
            <label>Jumlah Posyandu</label>
            <input type="number" name="jumlah_posyandu" class="form-control" value="{{ $data->jumlah_posyandu }}">
        </div>
        <div class="form-group">
            <label>Jumlah Kader</label>
            <input type="number" name="jumlah_kader" class="form-control" value="{{ $data->jumlah_kader }}">
        </div>
        <div class="form-group">
            <label>Jumlah Balita</label>
            <input type="number" name="jumlah_balita" class="form-control" value="{{ $data->jumlah_balita }}">
        </div>
        <div class="form-group">
            <label>Jumlah Stunting</label>
            <input type="number" name="jumlah_stunting" class="form-control" value="{{ $data->jumlah_stunting }}">
        </div>
        <div class="form-group">
            <label>Keterangan Stunting</label>
            <textarea name="keterangan_stunting" class="form-control">{{ $data->keterangan_stunting }}</textarea>
        </div>
        <div class="form-group">
            <label>Jumlah Wasting</label>
            <input type="number" name="jumlah_wasting" class="form-control" value="{{ $data->jumlah_wasting }}">
        </div>
        <div class="form-group">
            <label>Keterangan Wasting</label>
            <textarea name="keterangan_wasting" class="form-control">{{ $data->keterangan_wasting }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('data-desa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@stop
