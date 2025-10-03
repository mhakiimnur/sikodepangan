@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-bar-chart-fill fs-1"></i> | Daftar Level Pangan</h2>
            <br>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">    
                <a href="{{ route('level.create') }}" class="btn btn-outline-success">
                    ➕ Tambah Level
                </a>
                <form action="{{ route('level.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari jenis...">
                    <button type="submit" class="btn btn-outline-primary me-2">🔍</button>
                    @if(request('search'))
                        <a href="{{ route('level.index') }}" class="btn btn-outline-danger">❌</a>
                    @endif
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th style="width: 150px;">Kode Level</th>
                            <th>Nama Level</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_level as $item)
                            <tr>
                                <td>{{ $item->kode_level }}</td>
                                <td>{{ $item->nama_level }}</td>
                                <td class="text-center">
                                    <a href="{{ route('level.edit', $item->kode_level) }}" class="btn btn-outline-warning btn-sm">✏️</a>
                                    <form action="{{ route('level.destroy', $item->kode_level) }}" method="POST" style="display:inline-block;">
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
            {{ $data_level->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection