@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Rekap Data Posyandu Kecamatan</h4>

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
                        <th>NO</th>
                        <th>Nama Desa</th>
                        <th>Jumlah Posyandu</th>
                        <th>Jumlah Kader</th>
                        <th>Balita Normal</th>
                        <th>Wasting</th>
                        <th>Stunting</th>
                        <th>Total Balita</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekap as $i => $gizi)
                        <tr class="text-center">
                            <td>{{ $i + 1 }}</td>
                            <td class="text-start">{{ $gizi->nama_desa }}</td>
                            <td>{{ $gizi->jumlah_posyandu }}</td>
                            <td>{{ $gizi->jumlah_kader }}</td>
                            <td>{{ $gizi->balita_normal }}</td>
                            <td> {{ $gizi->balita_wasting }}</td>
                            <td>{{ $gizi->balita_stunting }}</td>
                            <td>{{ $gizi->total_balita }}</td>
                            <td> <a href="{{ route('admin.kecamatan.keterangan_balita.index', $gizi->id) }}" 
   class="btn btn-sm btn-info">
    Keterangan Balita
</a>

</td>
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

