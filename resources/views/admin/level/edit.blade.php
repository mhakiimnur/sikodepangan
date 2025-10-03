@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Level Pangan</h1>

    <form action="{{ route('level.update', $level->kode_level) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode_jenis" class="form-label">Jenis Pangan</label>
            <input type="text" class="form-control" value="{{ $jenis->kode_jenis }} - {{ $jenis->nama_jenis }}" readonly>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Level</label>
            <select name="kategori" id="kategori" class="form-control" required>
                @foreach($available as $item)
                    <option value="{{ $item['key'] }}" 
                        @if(substr($level->kode_level, -2) === $item['kode']) selected @endif>
                        {{ $item['label'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_level" class="form-label">Nama Level</label>
            <input type="text" class="form-control" value="{{ $level->nama_level }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('level.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
