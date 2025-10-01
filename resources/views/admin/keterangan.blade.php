@extends('layouts.app')

@section('title', 'Keterangan Balita')

@section('content')
<div class="container">
    <h2 class="mb-4">
        Keterangan Balita 
        @if($bulan)
            <small class="text-muted">(Periode: {{ $bulan }})</small>
        @endif
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Balita</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Desa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $balita)
                        <tr class="text-center">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $balita->nama_balita }}</td>
                            <td>{{ $balita->alamat }}</td>
                            <td>
                                @if($balita->status == 'Normal')
                                    <span class="badge bg-success">{{ $balita->status }}</span>
                                @elseif($balita->status == 'Stunting')
                                    <span class="badge bg-warning">{{ $balita->status }}</span>
                                @elseif($balita->status == 'Wasting')
                                    <span class="badge bg-info">{{ $balita->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $balita->status }}</span>
                                @endif
                            </td>
                            <td>{{ $balita->nama_desa ?? '-' }}</td>
                            <td>
                                <form action="{{ route('keterangan_balita.destroy', $balita->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data keterangan balita</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
