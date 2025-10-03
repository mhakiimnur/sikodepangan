@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Detail Kelompok Pangan</h1>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('admin.kelompok.index') }}" class="btn btn-danger">Kembali</a>
                    <!-- Tombol trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahKomoditas">
                      Tambah Komoditas
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th style="width: 150px;">Kode Kelompok</th>
                                <th>Nama Kelompok</th>
                                <th style="width: 150px;">Kode Komoditas</th>
                                <th>Nama Komoditas</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if($data_komoditas->count() > 0)
                              @foreach($data_komoditas as $index => $item)
                                  <tr>
                                      @if($index == 0)
                                          <td rowspan="{{ $data_komoditas->count() }}">
                                              {{ $kelompokPangan->kode_kelompok }}
                                          </td>
                                          <td rowspan="{{ $data_komoditas->count() }}">
                                              {{ $kelompokPangan->nama_kelompok }}
                                          </td>
                                      @endif
                                      <td>{{ $item->kode_komoditas }}</td>
                                      <td>{{ $item->nama_komoditas }}</td>
                                      <td>
                                        <!-- Tombol Edit -->
                                          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditKomoditas{{ $item->kode_komoditas }}">
                                              Edit
                                          </button>

                                          <!-- Tombol Delete -->
                                          <form action="{{ route('admin.komoditas.destroy', $item->kode_komoditas) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus komoditas ini?')">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-sm btn-danger">Delete</button>
                                          </form>
                                      </td>
                                  </tr>

                                  <!-- Modal Edit Komoditas -->
                                  <div class="modal fade" id="modalEditKomoditas{{ $item->kode_komoditas }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <form action="{{ route('admin.komoditas.update', $item->kode_komoditas) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <div class="modal-header">
                                            <h5 class="modal-title">Edit Komoditas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <label class="form-label">Kode Komoditas</label>
                                              <input type="text" class="form-control" value="{{ $item->kode_komoditas }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                              <label class="form-label">Nama Komoditas</label>
                                              <input type="text" name="nama_komoditas" class="form-control" value="{{ $item->nama_komoditas }}" required>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                              @endforeach
                          @else
                              <tr>
                                  <td colspan="4" class="text-center">
                                      {{ $kelompokPangan->kode_kelompok }} - {{ $kelompokPangan->nama_kelompok }} : Tidak ada data komoditas
                                  </td>
                              </tr>
                          @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $data_komoditas->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Modal Tambah Komoditas -->
        <div class="modal fade" id="modalTambahKomoditas" tabindex="-1" aria-labelledby="modalTambahKomoditasLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ route('admin.komoditas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTambahKomoditasLabel">Tambah Komoditas Pangan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">

                  <div class="mb-3">
                    <label for="kode_kelompok" class="form-label">Kode Kelompok</label>
                    <input type="text" class="form-control" name="kode_kelompok" value="{{ $kelompokPangan->kode_kelompok }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label for="kode_komoditas" class="form-label">Kode Komoditas</label>
                    <input type="text" class="form-control" name="kode_komoditas" value="{{ $nextKodeKomoditas }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label for="nama_komoditas" class="form-label">Nama Komoditas</label>
                    <input type="text" class="form-control" name="nama_komoditas" required>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
@endsection
