@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-diagram-3-fill fs-1"></i> | Edit Kelompok Pangan</h2>
        </div>
        <form action="{{ route('kelompok.update', $kelompokPangan->kode_kelompok) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mb-3">
                <label>Kode Kelompok</label>
                <input type="number" value="{{ $kelompokPangan->kode_kelompok }}" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label>Nama Kelompok</label>
                <input type="text" name="nama_kelompok" value="{{ $kelompokPangan->nama_kelompok }}" class="form-control" required>
                @error('nama_kelompok') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('kelompok.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        </form>
    </div>
@endsection
