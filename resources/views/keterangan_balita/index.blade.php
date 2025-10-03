@extends('layouts.app')

@section('title', 'Keterangan Balita')

@section('content')
<div class="container">
    <h2 class="mb-4">Keterangan Balita untuk Gizi: <strong>{{ $gizi->desa->nama_desa ?? '—' }} — tanggal {{ $gizi->created_at->format('d/m/Y') }}</strong></h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah di pojok kanan -->
    <div class="mb-3 d-flex justify-content-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah
        </button>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Balita</th>
                        <th>Usia (bln)</th>
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
                            <td>{{ $balita->usia }}</td>
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
                            <td>{{ $balita->desa->nama_desa ?? '-' }}</td>
                            <td>

                            <button class="btn btn-warning btn-sm me-1" 
            data-bs-toggle="modal" 
            data-bs-target="#editBalitaModal{{ $balita->id }}">
        <i class="fas fa-edit"></i>Edit
    </button>

    <form action="{{ route('keterangan_balita.destroy', $balita->id) }}" 
          method="POST" 
          class="d-inline" 
          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i> Hapus</button>
    </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data keterangan balita</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('keterangan_balita.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Keterangan Balita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Nama Balita</label>
              <input type="text" name="nama_balita" class="form-control" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Usia (bulan)</label>
              <input type="number" name="usia" class="form-control" min="0" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="2" required></textarea>
          </div>
          <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                  <option value="">-- Pilih --</option>
                  <option value="Normal">Normal</option>
                  <option value="Stunting">Stunting</option>
                  <option value="Wasting">Wasting</option>
              </select>
          </div>

          <!-- 1) kirim gizi_id ke server lewat hidden input -->
          <input type="hidden" name="gizi_id" value="{{ $gizi_id ?? $gizi->id }}">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>

@endsection

@foreach($data as $balita)
<div class="modal fade" id="editBalitaModal{{ $balita->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('keterangan_balita.update', $balita->id) }}" method="POST" class="modal-content">
      @csrf
      @method('PUT')

      <div class="modal-header">
        <h5 class="modal-title">Edit Keterangan Balita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Nama Balita</label>
              <input type="text" name="nama_balita" class="form-control" 
                     value="{{ $balita->nama_balita }}" required>
          </div>

          <div class="mb-3">
              <label class="form-label">Usia (bulan)</label>
              <input type="number" name="usia" class="form-control" 
                     value="{{ $balita->usia }}" required>
          </div>

          <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="2" required>{{ $balita->alamat }}</textarea>
          </div>

          <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                  <option value="Normal" {{ $balita->status == 'Normal' ? 'selected' : '' }}>Normal</option>
                  <option value="Stunting" {{ $balita->status == 'Stunting' ? 'selected' : '' }}>Stunting</option>
                  <option value="Wasting" {{ $balita->status == 'Wasting' ? 'selected' : '' }}>Wasting</option>
              </select>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
  </div>
</div>
@endforeach
