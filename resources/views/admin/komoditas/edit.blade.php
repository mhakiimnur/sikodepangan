@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Komoditas Pangan</h1>

    <form action="{{ route('komoditas.update', $komoditasPangan->kode_komoditas) }}" method="POST">
        @csrf
        @method('PUT') 

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

        <button class="btn btn-success">Update</button>
        <a href="{{ route('komoditas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
