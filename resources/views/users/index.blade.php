@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar User</h3>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#userModal">
            + Tambah User
        </button>
    </div>
    <div class="card-body">

        {{-- 🔴 tampilkan error global --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 🔵 tampilkan success message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered" id="userTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Desa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ ucfirst($u->role) }}</td>
                    <td>{{ $u->desa->nama_desa ?? '-' }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade @if ($errors->any()) show @endif" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true" @if ($errors->any()) style="display:block;" @endif>
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#userModal').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      {{-- Form method POST + csrf --}}
      <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>Role</label>
            <select class="form-control @error('role') is-invalid @enderror" name="role" id="roleSelect" required>
              <option value="">-- Pilih Role --</option>
              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="desa_id">Desa</label>
            <select name="desa_id" id="desa_id" class="form-control @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach($desas as $desa)
                    <option value="{{ $desa->id }}" {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                        {{ $desa->nama_desa }}
                    </option>
                @endforeach
            </select>
            @error('desa_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>

{{-- Script supaya modal otomatis kebuka kalau ada error --}}
@if ($errors->any())
<script>
    $(document).ready(function() {
        $('#userModal').modal('show');
    });
</script>
@endif

@endsection
