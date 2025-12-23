<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashPoint - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --trashpoint-soft-green: #38c172; 
            --trashpoint-dark-green: #218838; 
            --bg-light: #f4f7f6;
        }

        body { font-family: 'Inter', sans-serif; background-color: var(--bg-light); color: #333; }

        /* Sidebar User */
        .sidebar {
            width: 250px; height: 100vh; position: fixed; top: 0; left: 0;
            background-color: var(--trashpoint-soft-green); color: white;
            display: flex; flex-direction: column; transition: all 0.3s; z-index: 1030;
        }
        
        .sidebar a {
            color: white !important; text-decoration: none; padding: 12px 20px;
            display: flex; align-items: center; transition: 0.2s; margin: 4px 15px; border-radius: 8px;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.2); font-weight: 600; }

        /* Main Content Logic */
        .main-content { padding: 30px; transition: all 0.3s; min-height: 100vh; }
        .has-sidebar { margin-left: 250px; }
        .no-sidebar { margin-left: 0 !important; width: 100%; }

        /* Card & Hover Effects */
        .card-custom {
            border: none; border-radius: 15px;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(40, 167, 69, 0.15) !important;
        }

        .btn-trashpoint-logout { background-color: var(--trashpoint-dark-green); color: white; border: none; border-radius: 8px; }
    </style>
</head>
<body>
    @php $isAdmin = str_contains(session('temp_email', ''), 'admin'); @endphp

    @if(!$isAdmin)
        <div id="sidebar" class="sidebar">
            <div class="p-4 fw-bold fs-4 d-flex align-items-center">
                <i class="fas fa-trash-alt me-2"></i>TrashPoint
            </div>
            <div class="nav flex-column text-white">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i>Dashboard
                </a>
                <a href="{{ route('laporan') }}"><i class="fas fa-file-alt me-2"></i>Laporan</a>
                <a href="{{ route('pengaturan') }}"><i class="fas fa-cogs me-2"></i>Pengaturan</a>
            </div>
            <div class="mt-auto p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-trashpoint-logout w-100 py-2">Logout</button>
                </form>
            </div>
        </div>
    @endif

    <div id="mainContent" class="main-content {{ $isAdmin ? 'no-sidebar' : 'has-sidebar' }}">
        @if($isAdmin)
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 rounded-4 px-4 py-3">
                <div class="container-fluid">
                    <span class="navbar-brand fw-bold text-success d-flex align-items-center">
                        <i class="fas fa-user-shield me-2"></i> Admin Control Center
                    </span>
                    <div class="ms-auto">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>