@extends('adminlte::page')

@section('title', 'Laporan Desa')

@section('content_header')
    <h1>Laporan Data Desa</h1>
@stop

@section('content')
    <a href="{{ route('data-desa.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Periode</th>
                <th>Posyandu</th>
                <th>Kader</th>
                <th>Balita</th>
                <th>Stunting</th>
                <th>Wasting</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataDesa as $data)
                <tr>
                    <td>{{ $data->periode }}</td>
                    <td>{{ $data->jumlah_posyandu }}</td>
                    <td>{{ $data->jumlah_kader }}</td>
                    <td>{{ $data->jumlah_balita }}</td>
                    <td>{{ $data->jumlah_stunting }} <br>
                        <small>{{ $data->keterangan_stunting }}</small>
                    </td>
                    <td>{{ $data->jumlah_wasting }} <br>
                        <small>{{ $data->keterangan_wasting }}</small>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
