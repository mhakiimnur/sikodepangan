@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Dashboard Admin</h2>

    {{-- Ringkasan Data --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card text-bg-primary shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-diagram-3-fill fs-1"></i>
                    </div>
                    <div class="text-end flex-grow-1">
                        <h6>Kelompok Pangan</h6>
                        <h3>{{ $kelompokCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card text-bg-danger shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-basket2-fill fs-1"></i>
                    </div>
                    <div class="text-end flex-grow-1">
                        <h6>Komoditas</h6>
                        <h3>{{ $komoditasCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card text-bg-warning shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-layers-fill fs-1"></i>
                    </div>
                    <div class="text-end flex-grow-1">
                        <h6>Jenis Pangan</h6>
                        <h3>{{ $jenisCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card text-bg-success shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-bar-chart-fill fs-1"></i>
                    </div>
                    <div class="text-end flex-grow-1">
                        <h6>Level Pangan</h6>
                        <h3>{{ $levelCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hierarki Data Flat dengan Expand --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">TABEL KODE REFERENSI PANGAN</h5>
            {{-- Search --}}
            <form method="GET" action="{{ route('dashboard.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2"
                       placeholder="Cari data..." value="{{ $keyword ?? '' }}">
                <button type="submit" class="btn btn-sm btn-outline-primary me-2">🔍</button>
                @if(!empty($keyword))
                    <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-outline-danger">❌</a>
                @endif
            </form>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 100px;">Kode</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th style="width: 80px;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelompokList as $item)
                        {{-- Kelompok --}}
                        <tr class="table-info">
                            <td><strong>{{ $item->kode_kelompok }}</strong></td>
                            <td><strong>{{ $item->nama_kelompok }}</strong></td>
                            <td>Kelompok Pangan</td>
                            <td>
                                @if($item->koneksi_komoditas->count())
                                    <button class="btn btn-sm btn-primary"
                                            data-bs-toggle="collapse"
                                            data-bs-target=".komoditas-{{ $item->kode_kelompok }}">
                                        🔽
                                    </button>
                                @endif
                            </td>
                        </tr>

                        {{-- Komoditas --}}
                        @foreach($item->koneksi_komoditas as $komoditas)
                            <tr class="collapse komoditas-{{ $item->kode_kelompok }} table-danger">
                                <td>{{ $komoditas->kode_komoditas }}</td>
                                <td>{{ $komoditas->nama_komoditas }}</td>
                                <td>Komoditas Pangan</td>
                                <td>
                                    @if($komoditas->koneksi_jenis->count())
                                        <button class="btn btn-sm btn-primary"
                                                data-bs-toggle="collapse"
                                                data-bs-target=".jenis-{{ $komoditas->kode_komoditas }}">
                                            🔽
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            {{-- Jenis --}}
                            @foreach($komoditas->koneksi_jenis as $jenis)
                                <tr class="collapse jenis-{{ $komoditas->kode_komoditas }} table-warning">
                                    <td>{{ $jenis->kode_jenis }}</td>
                                    <td>{{ $jenis->nama_jenis }}</td>
                                    <td>Jenis Pangan</td>
                                    <td>
                                        @if($jenis->koneksi_level->count())
                                            <button class="btn btn-sm btn-primary"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target=".level-{{ $jenis->kode_jenis }}">
                                                🔽
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                {{-- Level --}}
                                @foreach($jenis->koneksi_level as $level)
                                    <tr class="collapse level-{{ $jenis->kode_jenis }}">
                                        <td>{{ $level->kode_level }}</td>
                                        <td>{{ $level->nama_level }}</td>
                                        <td>Level Pangan</td>
                                        <td>-</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Saat parent collapse ditutup, semua child ikut tertutup
        document.addEventListener('hidden.bs.collapse', function (e) {
            let children = e.target.querySelectorAll('.collapse.show');
            children.forEach(child => {
                new bootstrap.Collapse(child, { toggle: false }).hide();
            });
        });
    </script>
@endsection
