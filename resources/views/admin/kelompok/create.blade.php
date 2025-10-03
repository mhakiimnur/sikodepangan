@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-diagram-3-fill fs-1"></i> | Tambah Kelompok Pangan</h2>
        </div>
        <form action="{{ route('kelompok.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label>Kode Kelompok</label>
                <input type="number" name="kode_kelompok" class="form-control" value="{{ $nextKode }}" readonly>
                @error('kode_kelompok') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Nama Kelompok</label>
                <input type="text" name="nama_kelompok" class="form-control" required>
                @error('nama_kelompok') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>    
            <div class="card-footer">
                <button class="btn btn-success">Simpan</button>
                <a href="{{ route('kelompok.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
