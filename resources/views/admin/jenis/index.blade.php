@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Daftar Jenis Pangan</h2>
            <br>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">    
                <a href="{{ route('jenis.create') }}" class="btn btn-outline-success">
                    ➕ Tambah Jenis
                </a>
                <form action="{{ route('jenis.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari jenis...">
                    <button type="submit" class="btn btn-outline-primary me-2">🔍</button>
                    @if(request('search'))
                        <a href="{{ route('jenis.index') }}" class="btn btn-outline-danger">❌</a>
                    @endif
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-danger text-center">
                        <tr>
                            <th style="width: 150px;">Kode Jenis</th>
                            <th>Nama Jenis</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_jenis as $item)
                            <tr>
                                <td>{{ $item->kode_jenis }}</td>
                                <td>{{ $item->nama_jenis }}</td>
                                <td class="text-center">
                                    <a href="{{ route('jenis.edit', $item->kode_jenis) }}" class="btn btn-outline-warning btn-sm">✏️</a>
                                    <form action="{{ route('jenis.destroy', $item->kode_jenis) }}" method="POST" style="display:inline-block;">
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
            {{ $data_jenis->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection