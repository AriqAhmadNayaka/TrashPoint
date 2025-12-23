<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

use App\Models\Masyarakat;
use App\Models\Admin;
use App\Models\Trash;
use App\Models\DetailTrash;
use App\Models\User; 

// --- 1. HALAMAN UMUM ---
Route::get('/', function () { 
    $penggunaAktif = (Schema::hasTable('masyarakats')) ? Masyarakat::count() : 0; 
    $titikSampah = (Schema::hasTable('trashes')) ? Trash::count() : 0;
    $totalSampah = (Schema::hasTable('detail_trash')) ? DetailTrash::sum('berat') : 0;
    return view('landing', compact('penggunaAktif', 'titikSampah', 'totalSampah')); 
})->name('landing');

Route::get('/fitur', function () { return view('fitur'); })->name('fitur');
Route::get('/tentang-kami', function () { return view('deskripsi'); })->name('deskripsi');

Route::get('/berita/{id}', function ($id) { 
    return view('berita.detail', ['id' => $id]); 
})->name('berita.detail');

// --- 2. AUTHENTICATION ---
Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::post('/login', function (Request $request) { 
        session(['temp_email' => $request->email]);
        session(['temp_name' => strstr($request->email, '@', true) ?: $request->email]); 
        return redirect()->route('dashboard'); 
    })->name('login.post');

    Route::get('/register', function () { return view('auth.register'); })->name('register');
    Route::post('/register', function (Request $request) { 
        session(['temp_name' => $request->name, 'temp_email' => $request->email]);
        return redirect()->route('dashboard'); 
    })->name('register.post'); 
});

// --- 3. AREA DASHBOARD ---
Route::get('/dashboard', function () { 
    $user = Auth::user();
    $email = session('temp_email', $user->email ?? '');
    if (str_contains($email, 'admin') || (Schema::hasTable('admin') && Admin::where('user_id', Auth::id())->exists())) {
        return view('dashboard.admin'); 
    }
    return view('dashboard.index'); 
})->name('dashboard');

Route::get('/laporan', function () { return view('laporan'); })->name('laporan');
Route::get('/pengaturan', function () { return view('pengaturan'); })->name('pengaturan');

// --- TAMBAHAN RUTE PENGATURAN (SOLUSI ERROR profile.update) ---
Route::patch('/profile', function (Request $request) {
    // Logika sederhana update session agar form pengaturan bisa disubmit
    session(['temp_name' => $request->name]);
    return redirect()->back()->with('status', 'profile-updated');
})->name('profile.update');

// --- 4. AREA KHUSUS ADMIN (CRUD & POIN) ---
Route::prefix('admin')->group(function () {
    Route::get('/monitoring-sampah', function () { return view('admin.monitoring'); })->name('admin.monitoring');
    Route::get('/kelola-petugas', function () { return view('admin.petugas'); })->name('admin.petugas');
    
    // Hapus User
    Route::delete('/user/{id}', function ($id) {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User dihapus');
    })->name('admin.user.destroy');

    // Update Poin
    Route::patch('/user/{id}/poin', function (Request $request, $id) {
        User::where('id', $id)->update(['poin' => $request->poin]);
        return redirect()->back()->with('success', 'Poin diupdate');
    })->name('admin.user.update-poin');
});

// --- 5. LOGOUT ---
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('landing');
})->name('logout');