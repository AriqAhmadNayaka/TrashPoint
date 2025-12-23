@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <style>
        /* CSS Tambahan untuk Konsistensi Dashboard */
        :root {
            --trashpoint-soft-green: #38c172;
            --trashpoint-dark-green: #218838;
            --trashpoint-light-green-bg: #f0fff0;
        }

        /* Card Styling */
        .dashboard-card {
            border-left: 5px solid var(--trashpoint-soft-green); 
            background-color: var(--trashpoint-light-green-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
            color: #333; 
        }
        .dashboard-card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-title {
            color: var(--trashpoint-dark-green);
            font-weight: 600;
        }
        .card-text.display-4 {
            font-weight: 700;
        }

        .card-header-custom {
            background-color: white; 
            border-bottom: 3px solid var(--trashpoint-soft-green); 
            font-weight: bold;
        }
        .card-header-custom i {
             color: var(--trashpoint-dark-green);
        }

        /* Styling Berita */
        .news-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .news-item:last-child {
            border-bottom: none;
        }
        .news-date {
            font-size: 0.85rem;
            color: #888;
        }
    </style>
    
    <h1 class="mb-4" style="color: var(--trashpoint-dark-green);"><strong>Selamat datang!</strong></h1>
    
    <p class="lead mb-5">
        Halo, <strong>{{ session('temp_name') }}</strong>. 
        Mari bersama-sama jaga lingkungan kita. Dengan buang sampah pada tempatnya, Anda berkontribusi pada kebersihan Kota Bekasi.
    </p>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalTotalBins">
                <div class="card-body">
                    <h5 class="card-title">Total Unit Terdaftar</h5>
                    <p class="card-text display-4">120</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalCriticalStatus">
                <div class="card-body">
                    <h5 class="card-title text-danger">Unit Kritis (Penuh)</h5>
                    <p class="card-text display-4 text-danger">15</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalDailyCollection">
                <div class="card-body">
                    <h5 class="card-title">Tingkat Efisiensi Rute</h5>
                    <p class="card-text display-4" style="color: var(--trashpoint-soft-green);">+15%</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalSensorError">
                <div class="card-body">
                    <h5 class="card-title text-warning">Sensor Error</h5>
                    <p class="card-text display-4 text-warning">2</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header card-header-custom"><i class="fas fa-map-marker-alt me-2"></i> Peta Lokasi & Status Real-time</div>
                <div class="card-body">
                    <div style="height: 400px; background-color: #f8f9fa; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center;">
                        Integrasi Peta Interaktif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header card-header-custom"><i class="fas fa-newspaper me-2"></i> Berita Lingkungan Bekasi</div>
                <div class="card-body">
                    <div class="news-item">
                        <h6>Pemerintah Kota Bekasi Resmikan 50 Smart Bin Baru</h6>
                        <p class="news-date">15 Desember 2025</p>
                    </div>
                    <div class="news-item">
                        <h6>Kampanye Pilah Sampah: Poin Reward Naik 2x Lipat</h6>
                        <p class="news-date">10 Desember 2025</p>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-secondary w-100 mt-2">Lihat Semua Berita</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header card-header-custom"><i class="fas fa-exclamation-triangle me-2"></i> Tempat Sampah Membutuhkan Perhatian</div>
        <div class="card-body">
             <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Sampah</th>
                        <th>Lokasi</th>
                        <th>Tingkat Isi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TS-001</td>
                        <td>Jl. Sudirman No. 12</td>
                        <td class="text-danger">95%</td>
                        <td>Penuh</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @endsection