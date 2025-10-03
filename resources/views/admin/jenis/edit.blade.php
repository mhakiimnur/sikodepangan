@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Jenis Pangan</h1>

    <form action="{{ route('jenis.update', $jenisPangan->kode_jenis) }}" method="POST">
        @csrf
        @method('PUT') 

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

        <button class="btn btn-success">Update</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
