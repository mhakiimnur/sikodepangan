@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Daftar Kelompok Pangan</h2>
            <br>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">    
                <a href="{{ route('kelompok.create') }}" class="btn btn-outline-success">
                    ➕ Tambah Kelompok
                </a>
                <form action="{{ route('kelompok.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari kelompok...">
                    <button type="submit" class="btn btn-outline-primary me-2">🔍</button>
                    @if(request('search'))
                        <a href="{{ route('kelompok.index') }}" class="btn btn-outline-danger">❌</a>
                    @endif
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 150px;">Kode Kelompok</th>
                            <th>Nama Kelompok</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_kelompok as $item)
                            <tr>
                                <td>{{ $item->kode_kelompok }}</td>
                                <td>{{ $item->nama_kelompok }}</td>
                                <td class="text-center">
                                    <a href="{{ route('kelompok.edit', $item->kode_kelompok) }}" class="btn btn-outline-warning btn-sm">✏️</a>
                                    <form action="{{ route('kelompok.destroy', $item->kode_kelompok) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-outline-danger btn-sm">❌</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">    
            {{-- Pagination --}}
            {{ $data_kelompok->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
