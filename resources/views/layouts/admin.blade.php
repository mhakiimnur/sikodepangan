<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SiKodePangan - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 250px;
            background-color: #212529;
            color: #fff;
            flex-shrink: 0;
        }
        .content {
            flex-grow: 1;
            background: #f8f9fa;
            padding: 20px;
            overflow-y: auto;
        }
        .nav-link.active {
            font-weight: bold;
            background-color: #495057 !important;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar p-3">
        <h4 class="text-white mb-4">
            <i class="bi bi-kanban me-2"></i> SiKodePangan
        </h4>
        <ul class="nav flex-column">
            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" 
                   class="nav-link text-white {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                   <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            {{-- Master Data Kode --}}
            <li class="nav-item">
                <a class="nav-link text-white d-flex align-items-center justify-content-between" 
                   data-bs-toggle="collapse" href="#masterDataMenu" role="button"
                   aria-expanded="{{ request()->routeIs('kelompok.*') || request()->routeIs('komoditas.*') || request()->routeIs('jenis.*') || request()->routeIs('level.*') ? 'true' : 'false' }}">
                    <span><i class="bi bi-folder2-open me-2"></i> Master Data Kode</span>
                    <i class="bi bi-caret-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('kelompok.*') || request()->routeIs('komoditas.*') || request()->routeIs('jenis.*') || request()->routeIs('level.*') ? 'show' : '' }}" id="masterDataMenu">
                    <ul class="nav flex-column ms-3">
                        <li>
                            <a href="{{ route('kelompok.index') }}" 
                               class="nav-link text-white {{ request()->routeIs('kelompok.*') ? 'active' : '' }}">
                               <i class="bi bi-diagram-3 me-2"></i> Kelompok
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('komoditas.index') }}" 
                               class="nav-link text-white {{ request()->routeIs('komoditas.*') ? 'active' : '' }}">
                               <i class="bi bi-basket2 me-2"></i> Komoditas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jenis.index') }}" 
                               class="nav-link text-white {{ request()->routeIs('jenis.*') ? 'active' : '' }}">
                               <i class="bi bi-layers me-2"></i> Jenis
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('level.index') }}" 
                               class="nav-link text-white {{ request()->routeIs('level.*') ? 'active' : '' }}">
                               <i class="bi bi-bar-chart me-2"></i> Level
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            

            {{-- Logout --}}
            <li class="nav-item mt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
