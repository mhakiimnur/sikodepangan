@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detail Komoditas Pangan</h1>
    <a href="{{ route('admin.komoditas.index') }}" class="btn btn-danger mb-3">Kembali</a>
    <!-- Tombol Tambah Jenis -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahJenisModal">
        Tambah Jenis
    </button>

    <!-- Modal Tambah Jenis -->
    <div class="modal fade" id="tambahJenisModal" tabindex="-1" aria-labelledby="tambahJenisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{ route('admin.jenis.store') }}" method="POST">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="tambahJenisModalLabel">Tambah Jenis</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label>Kode Komoditas</label>
                    <input type="text" name="kode_komoditas" class="form-control" 
                        value="{{ $komoditasPangan->kode_komoditas }}" disabled>
                </div>

                <div class="mb-3">
                    <label>Kode Jenis</label>
                    <input type="number" name="kode_jenis" class="form-control" 
                        value="{{ $nextKodeJenis }}" disabled>
                </div>

                <div class="mb-3">
                    <label>Nama Jenis</label>
                    <input type="text" name="nama_jenis" class="form-control" required>
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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Komoditas</th>
                <th>Nama Komoditas</th>
                <th>Kode Jenis</th>
                <th>Nama Jenis</th>
            </tr>
        </thead>
        <tbody>
            @if($data_jenis->count() > 0)
                @foreach($data_jenis as $index => $item)
                    <tr>
                        {{-- tampilkan Komdotas hanya di baris pertama --}}
                        @if($index == 0)
                            <td rowspan="{{ $data_jenis->count() }}">
                                {{ $komoditasPangan->kode_komoditas }}
                            </td>
                            <td rowspan="{{ $data_jenis->count() }}">
                                {{ $komoditasPangan->nama_komoditas }}
                            </td>
                        @endif
                        <td>{{ $item->kode_jenis }}</td>
                        <td>{{ $item->nama_jenis }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">
                        {{ $komoditasPangan->kode_komoditas }} - {{ $komoditasPangan->nama_komoditas }} : Tidak ada data jenis
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $data_jenis->links('pagination::bootstrap-5') }}
</div>
@endsection
