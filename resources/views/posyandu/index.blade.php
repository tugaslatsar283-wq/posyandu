@extends('layouts.app')

@section('title', 'Data Posyandu')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Posyandu</h3>
        @if(Auth::user()->role === 'operator')
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal">
            + Tambah Data
        </button>
        @endif
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Desa</th>
                    <th>Jumlah Posyandu</th>
                    <th>Jumlah Balita</th>
                    <th>Balita Normal</th>
                    <th>Balita Stunting</th>
                    <th>Balita Wasting</th>
                    <th>Jumlah Kader</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posyandus as $p)
                <tr>
                    <td>{{ $p->desa->nama_desa }}</td>
                    <td>{{ $p->jumlah_posyandu }}</td>
                    <td>{{ $p->jumlah_balita }}</td>
                    <td>{{ $p->jumlah_balita_normal }}</td>
                    <td>{{ $p->jumlah_balita_stunting }}</td>
                    <td>{{ $p->jumlah_balita_wasting }}</td>
                    <td>{{ $p->jumlah_kader }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Create --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data Posyandu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('posyandu.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Jumlah Posyandu</label>
                <input type="number" name="jumlah_posyandu" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jumlah Balita</label>
                <input type="number" name="jumlah_balita" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Balita Normal</label>
                <input type="number" name="jumlah_balita_normal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Balita Stunting</label>
                <input type="number" name="jumlah_balita_stunting" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Balita Wasting</label>
                <input type="number" name="jumlah_balita_wasting" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jumlah Kader</label>
                <input type="number" name="jumlah_kader" class="form-control" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
