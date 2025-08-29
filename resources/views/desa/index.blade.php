@extends('layouts.app')

@section('title', 'Data Desa')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Desa</h3>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#desaModal">
            + Tambah Desa
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="desaTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Desa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($desa as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_desa }}</td>
                    <td>
                        <a href="{{ route('desa.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('desa.destroy', $d->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus desa ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Desa -->
<div class="modal fade" id="desaModal" tabindex="-1" role="dialog" aria-labelledby="desaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="desaModalLabel">Tambah Desa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="formTambahDesa" method="POST" action="{{ route('desa.store') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_desa">Nama Desa</label>
            <input type="text" class="form-control" id="nama_desa" name="nama_desa" required>
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
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function () {
      $('#formTambahDesa').submit(function (e) {
          e.preventDefault();

          $.ajax({
              url: "{{ route('desa.store') }}",
              type: "POST",
              data: $(this).serialize(),
              success: function (response) {
                  if(response.success){
                      $('#desaModal').modal('hide');
                      $('#formTambahDesa')[0].reset();

                      let rowCount = $('#desaTable tbody tr').length + 1;

                      $('#desaTable tbody').append(`
                          <tr>
                              <td>${rowCount}</td>
                              <td>${response.desa.nama_desa}</td>
                              <td>
                                  <a href="/desa/${response.desa.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                  <form action="/desa/${response.desa.id}" method="POST" style="display:inline">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus desa ini?')">Hapus</button>
                                  </form>
                              </td>
                          </tr>
                      `);

                      // ✅ SweetAlert sukses
                      Swal.fire({
                          toast: true,
                          icon: 'success',
                          title: 'Desa berhasil ditambahkan',
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 2000,
                          timerProgressBar: true
                      });
                  }
              },
              error: function (xhr) {
                  Swal.fire({
                      toast: true,
                      icon: 'error',
                      title: 'Gagal menambahkan desa',
                      text: xhr.responseText,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 2500,
                      timerProgressBar: true
                  });
              }
          });
      });
  });
</script>
@endpush
