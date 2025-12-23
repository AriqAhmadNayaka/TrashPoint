@extends('layouts.app')

@section('title', 'Admin Dashboard Monitoring')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-success mb-0">Admin Control Page</h2>
            <p class="text-muted">Monitoring TrashPoint Bekasi</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-white shadow-sm rounded-pill px-3 border">
                <i class="fas fa-sync-alt text-success"></i> Refresh Data
            </button>
            <button class="btn btn-success rounded-pill px-4 shadow-sm hover-elevate">
                <i class="fas fa-file-export me-2"></i>Export Excel
            </button>
        </div>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-md-3">
            <div class="card card-custom h-100 border-start border-success border-5 shadow-sm bg-white">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <div class="text-success mb-2"><i class="fas fa-trash-alt fa-2x"></i></div>
                    <h6 class="text-uppercase small fw-bold text-muted">Total Smart Bin</h6>
                    <h2 class="fw-black mb-0 text-dark">{{ \App\Models\Trash::count() }} <span class="fs-6 fw-normal">Unit</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom h-100 bg-success text-white shadow-sm border-0">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <h2 class="fw-bold mb-0">123.50 kg</h2>
                    <h6 class="text-uppercase small opacity-75">Input Sampah (Hari Ini)</h6>
                    <div class="mt-2 small"><i class="fas fa-arrow-up"></i> 12% Dari Kemarin</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom h-100 border-success shadow-sm bg-white" style="border: 2px solid var(--trashpoint-soft-green);">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <div class="text-success mb-2"><i class="fas fa-cloud-upload-alt fa-2x"></i></div>
                    <h6 class="text-uppercase small fw-bold text-muted">Collectime Status</h6>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-success">68D391</span>
                        <span class="badge bg-dark">978</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom h-100 border-0 shadow-sm text-white" style="background-color: var(--trashpoint-dark-green);">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <h2 class="fw-bold mb-0">56</h2>
                    <h6 class="text-uppercase small opacity-75">Petugas Aktif</h6>
                    <hr class="my-2 opacity-25">
                    <small>Wilayah Bekasi Timur</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-8">
            <div class="card card-custom shadow-sm border-0 h-100 bg-white">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success"><i class="fas fa-chart-line me-2"></i>Volume Sampah Mingguan</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <canvas id="trashChart" style="max-height: 280px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom shadow-sm border-0 h-100 bg-white">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success">Komposisi Sampah</h5>
                </div>
                <div class="card-body d-flex align-items-center">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-custom shadow-sm border-0 mb-5 bg-white">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-4 px-4 border-bottom">
            <div>
                <h5 class="fw-bold mb-0 text-success"><i class="fas fa-coins me-2"></i>Manajemen Poin & User</h5>
                <small class="text-muted">Kelola data reward harian pengguna TrashPoint</small>
            </div>
            <button class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-user-plus me-2"></i>Tambah User
            </button>
        </div>
        <div class="table-responsive px-4 py-2">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-muted small">
                        <th class="border-0">NAMA PENGGUNA</th>
                        <th class="border-0">SMART BIN ID</th>
                        <th class="border-0 text-center">INPUT POIN HARI INI</th>
                        <th class="border-0 text-center">TOTAL POIN</th>
                        <th class="border-0 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::all() as $user)
                    <tr class="hover-row">
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success-subtle text-success fw-bold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $user->name }}</div>
                                    <div class="small text-muted">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-success border border-success px-3">BKS-{{ $user->id }}</span></td>
                        <td style="width: 220px;">
                            <form action="{{ route('admin.user.update-poin', $user->id) }}" method="POST" class="d-flex align-items-center">
                                @csrf @method('PATCH')
                                <div class="input-group input-group-sm shadow-sm">
                                    <input type="number" name="poin_baru" class="form-control border-success text-center" placeholder="+0">
                                    <button type="submit" class="btn btn-success px-3" title="Simpan Poin">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td class="text-center">
                            <span class="fw-bold text-success fs-5">{{ number_format($user->poin ?? 0, 0, ',', '.') }}</span>
                            <div class="small text-muted" style="font-size: 10px;">POIN TERAKHIR</div>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary border-0 hover-scale"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 hover-scale"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-custom shadow-sm border-0 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 border-bottom pb-3">
            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-history me-2 text-success"></i>Log Aktivitas Perangkat</h5>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                @for($i = 1; $i <= 10; $i++)
                <div class="list-group-item p-4 border-0 border-bottom hover-row">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex">
                            <div class="p-2 bg-light rounded-3 me-3 text-success">
                                <i class="fas fa-microchip fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Smart Bin Bekasi Timur #0{{ $i }} Terdeteksi Penuh</h6>
                                <p class="mb-0 text-muted small">Lokasi: Jl. Ahmad Yani No. {{ $i }}, Bekasi Selatan</p>
                                <span class="badge bg-danger-subtle text-danger mt-2">Segera Kosongkan</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">{{ now()->subMinutes($i * 5)->diffForHumans() }}</small>
                            <button class="btn btn-sm btn-light mt-2 text-success border">Detail</button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
        <div class="card-footer bg-light border-0 text-center py-3">
            <a href="#" class="text-success fw-bold text-decoration-none small">Lihat Semua Aktivitas <i class="fas fa-chevron-right ms-1"></i></a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Trash Volume Chart
    const ctx = document.getElementById('trashChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Volume Sampah (kg)',
                data: [65, 85, 75, 120, 95, 140, 123],
                borderColor: '#38c172',
                backgroundColor: 'rgba(56, 193, 114, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#38c172',
                pointRadius: 5
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { display: false } }, x: { grid: { display: false } } }
        }
    });

    // Category Chart
    const ctx2 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Organik', 'Anorganik', 'B3'],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#38c172', '#ffc107', '#dc3545'],
                hoverOffset: 10,
                borderWidth: 0
            }]
        },
        options: {
            cutout: '75%',
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } }
        }
    });
</script>
@endpush
@endsection