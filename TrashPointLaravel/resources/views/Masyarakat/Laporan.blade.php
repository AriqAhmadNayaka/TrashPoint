@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    <h1 class="mb-4" style="color: var(--trashpoint-dark-green);">Analisis dan Laporan Data</h1>
    <p class="lead">Lihat performa operasional, efisiensi rute, dan metrik lingkungan historis.</p>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">Grafik Efisiensi Bulanan</div>
                <div class="card-body" style="height: 300px;">
                    [Placeholder Grafik Bar atau Line]
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">Laporan Poin Reward</div>
                <div class="card-body" style="height: 300px;">
                    [Placeholder Tabel Peringkat Pengguna]
                </div>
            </div>
        </div>
    </div>
@endsection