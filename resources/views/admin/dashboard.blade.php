@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Rekap Data Posyandu per Desa</h4>

    <!-- Filter Bulan -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="month" name="bulan" class="form-control" 
                       value="{{ request('bulan', now()->format('Y-m')) }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Rekap -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Desa</th>
                        <th>Jumlah Posyandu</th>
                        <th>Jumlah Kader</th>
                        <th>Balita Normal</th>
                        <th>Wasting</th>
                        <th>Stunting</th>
                        <th>Total Balita</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekap as $row)
                    <tr>
                        <td>{{ $row->nama_desa }}</td>
                        <td>{{ $row->jumlah_posyandu }}</td>
                        <td>{{ $row->jumlah_kader }}</td>
                        <td>{{ $row->balita_normal }}</td>
                        <td>{{ $row->wasting }}</td>
                        <td>{{ $row->stunting }}</td>
                        <td>{{ $row->total_balita }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
