@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Rekap Data Posyandu per Desa</h4>

    <form method="GET" action="{{ route('admin.dashboard') }}">
        <div class="row g-3 align-items-end">
            <!-- Filter bulan -->
            <div class="col-md-3">
                <label for="bulan" class="form-label">Pilih Bulan</label>
                <input type="month" name="bulan" id="bulan"
                       class="form-control"
                       value="{{ request('bulan', now()->format('Y-m')) }}">
            </div>

            <!-- Tombol Filter + Print -->
            <div class="col-md-6 d-flex align-items-center">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ route('admin.dashboard.print', ['bulan' => request('bulan', now()->format('Y-m'))]) }}"
                   class="btn btn-danger" target="_blank">
                    <i class="fas fa-file-pdf"></i> Print PDF
                </a>
            </div>
        </div>
    </form>

    <div class="card mt-4">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-dark text-center">
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
                    @forelse($rekap as $data)
                        <tr class="text-center">
                            <td class="text-start">{{ $data->nama_desa }}</td>
                            <td>{{ $data->jumlah_posyandu }}</td>
                            <td>{{ $data->jumlah_kader }}</td>
                            <td>{{ $data->balita_normal }}</td>
                            <td>{{ $data->wasting }}</td>
                            <td>{{ $data->stunting }}</td>
                            <td>{{ $data->total_balita }}</td>
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