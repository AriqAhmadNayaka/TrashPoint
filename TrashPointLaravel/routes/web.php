<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('Landing');
})->name('Landing.Page');

Route::get('/fitur', function () {
    return view('Fitur');
})->name('Fitur.Page');

Route::get('/tentang-kami', function () {
    return view('Deskripsi');
})->name('Deskripsi.Page');

// Route::get('/berita/{id}', function ($id) {
//     return view('berita.detail', ['id' => $id]);
// })->name('berita.detail');

// =================================================================================================

// --- 2. AUTHENTICATION ---
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('Login.Page');

Route::get('/register', function () {
    return view('auth.register');
})->name('Register.Page');
Route::post('/register', [UserController::class, 'store'])->name('register');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/profile', function () {
        return view('Profile.Profile');
    })->name('Profile.Page');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/homepage', function () {
            return view('Admin.Homepage');
        })->name('Admin.Homepage.Page');

        Route::get('/admin/schedule', function () {
            return view('Admin.Schedule');
        })->name('Admin.Schedule.Page');
    });

    Route::middleware(['role:masyarakat'])->group(function () {
        Route::get('/masyarakat/homepage', function () {
            return view('Masyarakat.Homepage');
        })->name('Masyarakat.Homepage.Page');

        Route::get('/masyarakat/laporan', function () {
            return view('Masyarakat.Laporan');
        })->name('Masyarakat.Laporan.Page');

        Route::get('/masyarakat/pengaturan', function () {
            return view('Masyarakat.Pengaturan');
        })->name('Masyarakat.Pengaturan.Page');
    });

    Route::middleware(['role:petugas'])->group(function () {
        Route::get('/petugas/homepage', function () {
            return view('Petugas.Homepage');
        })->name('Petugas.Homepage.Page');
    });
});

// require __DIR__ . '/auth.php';

// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');