<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\Admin;
use App\Models\Trash;
use App\Models\DetailTrash;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    // Menampilkan halaman depan (Landing Page)
    public function index()
    {
        // Ambil data statistik untuk ditampilkan di landing page
        $penggunaAktif = Masyarakat::count();
        $titikSampah = Trash::count();
        $totalSampah = DetailTrash::sum('berat');

        return view('landing', compact('penggunaAktif', 'titikSampah', 'totalSampah'));
    }

    // Fungsi baru untuk mengatur arah Dashboard setelah Login
    public function dashboard()
    {
        $userId = Auth::id();

        // 1. Jika User ID ada di tabel Admin, arahkan ke dashboard admin
        if (Admin::where('user_id', $userId)->exists()) {
            // Buat file admin.blade.php di folder dashboard nanti
            return view('dashboard.admin'); 
        }

        // 2. Jika User ID ada di tabel Masyarakat, arahkan ke index (User)
        if (Masyarakat::where('user_id', $userId)->exists()) {
            // Ini file yang sudah kamu buat untuk User
            return view('dashboard.index'); 
        }

        // Jika tidak terdaftar di keduanya (fallback)
        return redirect('/')->with('error', 'Role tidak dikenali.');
    }
}