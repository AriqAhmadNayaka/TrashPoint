@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4" style="color: var(--trashpoint-dark-green); font-weight: bold;">Pengaturan Sistem</h1>
    <p class="lead text-muted">Kelola akun dan konfigurasi TrashPoint secara real-time.</p>
    
    <div class="card shadow-sm border-0 p-4" style="border-radius: 15px; width: 100%;">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH') 
            
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success border-0 shadow-sm mb-4">Profil berhasil diperbarui!</div>
            @endif
            
            <div class="mb-4">
                <label class="form-label fw-bold">Nama Akun</label>
                <input type="text" name="name" class="form-control py-3" 
                       value="{{ session('temp_name', Auth::user()->name ?? 'Operator') }}" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control py-3" 
                       value="{{ session('temp_email', Auth::user()->email ?? 'operator@trashpoint.id') }}" required>
            </div>

            <button type="submit" class="btn btn-success px-5 py-2" style="background-color: #218838; font-weight: bold;">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection