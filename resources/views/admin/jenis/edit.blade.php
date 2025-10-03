@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-layers-fill fs-1"></i> | Edit Jenis Pangan</h2>
        </div>
        <form action="{{ route('jenis.update', $jenisPangan->kode_jenis) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mb-3">
                <label>Kode dan Nama Komoditas</label>
                <select name="kode_komoditas" class="form-control" disabled>
                    @foreach($data_komoditas as $komoditas)
                        <option value="{{ $komoditas->kode_komoditas }}" {{ $jenisPangan->kode_komoditas == $komoditas->kode_komoditas ? 'selected' : '' }}>
                            {{ $komoditas->kode_komoditas }} - {{ $komoditas->nama_komoditas }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Kode Jenis</label>
                <input type="number" name="kode_jenis" class="form-control" value="{{ $jenisPangan->kode_jenis }}" readonly>
            </div>
            <div class="mb-3">
                <label>Nama Jenis</label>
                <input type="text" name="nama_jenis" class="form-control" value="{{ $jenisPangan->nama_jenis }}" required>
            </div>
        </div> 
        <div class="card-footer">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
        </div>
        </form>
    </div>
@endsection
