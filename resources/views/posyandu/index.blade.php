@extends('layouts.app')

@section('title', 'Data Posyandu & Gizi Balita')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 text-center font-weight-bold">Data Posyandu & Gizi Balita</h4>

    {{-- Data Posyandu --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <div class="row align-items-center">
            {{-- Kolom kiri --}}
            <div class="col-md-3 col-4">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPosyandu">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>

            {{-- Kolom tengah --}}
            <div class="col-md-6 col-8 text-center">
                <h5 class="m-0">Data Posyandu</h5>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th style="width: 50px;">No</th>
                    <th>Jumlah Posyandu</th>
                    <th>Jumlah Kader</th>
                    <th>Tanggal Input</th>
                    <th style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataPosyandu as $index => $posyandu)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $posyandu->jumlah_posyandu }}</td>
                        <td>{{ $posyandu->jumlah_kader }}</td>
                        <td>{{ $posyandu->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('posyandu.destroy', $posyandu->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data Posyandu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


   {{-- Data Gizi Balita --}}
<div class="card shadow-sm">
    <div class="card-header bg-light">
        <div class="row align-items-center">
            {{-- Kolom kiri --}}
            <div class="col-md-3 col-4">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalGizi">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>

            {{-- Kolom tengah --}}
            <div class="col-md-6 col-4 text-center">
                <h5 class="m-0">Data Gizi Balita</h5>
            </div>

            {{-- Kolom kanan --}}
            <div class="col-md-3 col-4 text-end">
                <form method="GET" action="{{ route('posyandu.index') }}" class="d-flex justify-content-end">
                    <input type="month" name="bulan" value="{{ request('bulan') }}" class="form-control form-control-sm me-2">
                    <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th style="width: 50px;">No</th>
                    <th>Balita Normal</th>
                    <th>Wasting</th>
                    <th>Stunting</th>
                    <th>Total Balita</th>
                    <th>Tanggal Input</th>
                    <th style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataGizi as $index => $gizi)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $gizi->jumlah_balita_normal }}</td>
                        <td>{{ $gizi->jumlah_balita_wasting }}</td>
                        <td>{{ $gizi->jumlah_balita_stunting }}</td>
                        <td>{{ $gizi->jumlah_balita_normal + $gizi->jumlah_balita_wasting + $gizi->jumlah_balita_stunting }}</td>
                        <td>{{ $gizi->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('gizi.destroy', $gizi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data Gizi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>




{{-- Modal Posyandu --}}
<div class="modal fade" id="modalPosyandu" tabindex="-1" aria-labelledby="modalPosyanduLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('posyandu.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalPosyanduLabel">Tambah Data Posyandu</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Jumlah Posyandu</label>
          <input type="number" name="jumlah_posyandu" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Jumlah Kader</label>
          <input type="number" name="jumlah_kader" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- Modal Gizi --}}
<div class="modal fade" id="modalGizi" tabindex="-1" aria-labelledby="modalGiziLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('gizi.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalGiziLabel">Tambah Data Gizi Balita</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Balita Normal</label>
          <input type="number" name="jumlah_balita_normal" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Balita Wasting</label>
          <input type="number" name="jumlah_balita_wasting" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Balita Stunting</label>
          <input type="number" name="jumlah_balita_stunting" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
