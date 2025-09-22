@extends('layouts.app')

@section('content')
<div class="container">
   <h2 class="mb-4">
    Daftar Keterangan Balita - Bulan {{ $gizi->bulan }} Tahun {{ $gizi->tahun }}
</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah pakai modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
        + Tambah
    </button>

    <div class="card mt-4">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Balita</th>
                        <th>Usia</th>
                        <th>Alamat</th>
                        <th>Desa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $balita)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $balita->nama_balita }}</td>
                            <td>{{ $balita->usia }} bulan</td>
                            <td>{{ $balita->alamat }}</td>
                            <td>
                                @if($balita->status == 'Normal')
                                    <span class="badge bg-success">{{ $balita->status }}</span>
                                @elseif($balita->status == 'Stunting')
                                    <span class="badge bg-warning">{{ $balita->status }}</span>
                                @elseif($balita->status == 'Wasting')
                                    <span class="badge bg-info">{{ $balita->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $balita->status }}</span>
                                @endif
                            </td>
                            <td>{{ $balita->desa->nama_desa ?? '-' }}</td>
                            <td>
                                <a href="{{ route('keterangan_balita.edit', $balita->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('keterangan_balita.destroy', $balita->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('keterangan_balita.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Keterangan Balita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Balita</label>
                    <input type="text" name="nama_balita" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Usia (bulan)</label>
                    <input type="number" name="usia" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Stunting">Stunting</option>
                        <option value="Wasting">Wasting</option>
                    </select>
                </div>
                <!-- Desa ID otomatis dari user login -->
                <input type="hidden" name="desa_id" value="{{ Auth::user()->desa_id }}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
