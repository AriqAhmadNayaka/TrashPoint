<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

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
    <body class="font-sans antialiased w-full h-screen flex flex-row">

            {{-- Navigation --}}
            @include('layouts.navigation')

            <!-- Page Heading -->
            <div class="w-10/12 flex flex-col mt-5">
                @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset
                
                <!-- Page Content -->
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
