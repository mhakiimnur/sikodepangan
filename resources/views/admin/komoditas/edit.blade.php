@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-basket2-fill fs-1"></i> | Edit Komoditas Pangan</h2>
        </div>
        <form action="{{ route('komoditas.update', $komoditasPangan->kode_komoditas) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mb-3">
                <label>Kode dan Nama Kelompok</label>
                <select name="kode_kelompok" class="form-control" disabled>
                    @foreach($data_kelompok as $kelompok)
                        <option value="{{ $kelompok->kode_kelompok }}" {{ $komoditasPangan->kode_kelompok == $kelompok->kode_kelompok ? 'selected' : '' }}>
                            {{ $kelompok->kode_kelompok }} - {{ $kelompok->nama_kelompok }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Kode Komoditas</label>
                <input type="number" name="kode_komoditas" class="form-control" value="{{ $komoditasPangan->kode_komoditas }}" readonly>
            </div>
            <div class="mb-3">
                <label>Nama Komoditas</label>
                <input type="text" name="nama_komoditas" class="form-control" value="{{ $komoditasPangan->nama_komoditas }}" required>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('komoditas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        </form>
    </div>
@endsection
