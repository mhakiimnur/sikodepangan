<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ECBA1E;
        }

        /* Hero Section */
        .hero {
            background: url('{{ asset("images/bg-sikodepangan.jpg") }}') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 120px 0;
            position: relative;
            z-index: 1;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.6);
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(30, 120, 22, 0.6); /* overlay hijau transparan */
            z-index: -1;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.5rem;
        }

        .btn-hero {
            margin-top: 20px;
            font-weight: bold;
            padding: 12px 28px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        /* Cards API */
        .card {
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .input-group-text {
            min-width: 60px;
            justify-content: center;
        }

        footer {
            margin-top: 50px;
            padding: 25px;
            background: #212529;
            color: #bbb;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container">
            <h1>Selamat Datang di {{ config('app.name', 'Laravel') }}</h1>
            <p class="mt-3">Sistem Informasi Kode Referensi Pangan (SiKodePangan)</p>
            <p class="mt-3">Merupakan pengembangan antarmuka pemrograman aplikasi (API) Kode Referensi Pangan.</p>
        </div>
    </section>

    <!-- Content -->
    <div class="container py-5 text-center">
        <h2 class="mb-5">Daftar Endpoint API Kode Referensi Pangan</h2>
        <div class="row g-4">

            <!-- Kelompok Pangan -->
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">🚀 Endpoint Kelompok Pangan</h5>
                        <p class="card-text">Mengambil daftar seluruh kelompok pangan.</p>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><strong>GET</strong></span>
                            <input type="text" class="form-control" id="endpointAllKelompok" value="{{ url('/api/v1/kelompok-pangan') }}" readonly>
                            <button class="btn btn-outline-secondary" onclick="copyToClipboard('endpointAllKelompok')">Copy</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Komoditas Pangan -->
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">🎨 Endpoint Komoditas Pangan</h5>
                        <p class="card-text">Mengambil daftar seluruh komoditas pangan.</p>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><strong>GET</strong></span>
                            <input type="text" class="form-control" id="endpointAllKomoditas" value="{{ url('/api/v1/komoditas-pangan') }}" readonly>
                            <button class="btn btn-outline-secondary" onclick="copyToClipboard('endpointAllKomoditas')">Copy</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jenis Pangan -->
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">🔒 Endpoint Jenis Pangan</h5>
                        <p class="card-text">Mengambil daftar seluruh jenis pangan.</p>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><strong>GET</strong></span>
                            <input type="text" class="form-control" id="endpointAllJenis" value="{{ url('/api/v1/jenis-pangan') }}" readonly>
                            <button class="btn btn-outline-secondary" onclick="copyToClipboard('endpointAllJenis')">Copy</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Level Pangan -->
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">📊 Endpoint Level Pangan</h5>
                        <p class="card-text">Mengambil daftar seluruh level pangan.</p>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><strong>GET</strong></span>
                            <input type="text" class="form-control" id="endpointAllLevel" value="{{ url('/api/v1/level-pangan') }}" readonly>
                            <button class="btn btn-outline-secondary" onclick="copyToClipboard('endpointAllLevel')">Copy</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Kode Referensi Pangan -->
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">TABEL KODE REFERENSI PANGAN</h5>
                        {{-- Search --}}
                        <form method="GET" action="{{ route('welcome.index') }}" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2"
                                placeholder="Cari data..." value="{{ $keyword ?? '' }}">
                            <button type="submit" class="btn btn-sm btn-outline-primary me-2">🔍</button>
                            @if(!empty($keyword))
                                <a href="{{ route('welcome.index') }}" class="btn btn-sm btn-outline-danger">❌</a>
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
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} PUSDATIN PANGAN. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Copy to Clipboard -->
    <script>
        function copyToClipboard(elementId) {
            var copyText = document.getElementById(elementId);
            copyText.select();
            copyText.setSelectionRange(0, 99999); // Untuk mobile
            navigator.clipboard.writeText(copyText.value).then(function() {
                alert("✅ Endpoint berhasil disalin: " + copyText.value);
            });
        }
    </script>
</body>
</html>
