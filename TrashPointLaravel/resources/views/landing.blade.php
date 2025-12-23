<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashPoint - Solusi Sampah Pintar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --green-primary: #218838;
            --green-hover: #1a6d2c; 
            --green-light-bg: #f8fff8;
            --text-dark: #212529;
            --text-secondary: #6c757d;
        }

        body { 
            padding-top: 70px; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        } 

        /* --- NAVBAR --- */
        .navbar-standard { 
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
            background-color: white !important; 
        }
        .navbar-brand { font-weight: bold !important; }
        .navbar-standard .nav-link { 
            color: var(--text-dark) !important;
            transition: all 0.2s; 
        }
        .navbar-standard .nav-link.active { 
            font-weight: bold; 
            color: var(--green-primary) !important; 
            border-bottom: 2px solid var(--green-primary);
        }

        /* --- BUTTON HOVER SAMA --- */
        .btn-success, .btn-outline-success {
            transition: all 0.3s ease !important;
            border-radius: 8px;
        }
        .btn-success:hover, .btn-outline-success:hover { 
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(33, 136, 56, 0.3);
        }
        .btn-success { background-color: var(--green-primary) !important; border-color: var(--green-primary) !important; color: white !important; }
        .btn-success:hover { background-color: var(--green-hover) !important; }

        /* --- HERO SECTION --- */
        .bg-gradient-trash {
            background-color: white; 
            background-image: radial-gradient(at 10% 10%, #e6ffe6 0%, transparent 50%),
                              radial-gradient(at 90% 90%, #f0fff0 0%, transparent 50%);
            min-height: 80vh; 
            display: flex;
            align-items: center;
            padding: 100px 0;
        }
        .hero-title { font-size: 3.8rem; font-weight: 800; color: var(--text-dark); letter-spacing: -1px; }
        .hero-tagline { font-size: 1.3rem; color: var(--text-secondary); line-height: 1.8; }

        /* --- IMPACT SECTION --- */
        .impact-section { padding: 120px 0; background: white; }
        .impact-card {
            background: white;
            border-radius: 20px;
            padding: 45px 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            border-top: 6px solid var(--green-primary);
            transition: all 0.4s ease;
            height: 100%;
        }
        .impact-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }
        .impact-card i { color: var(--green-primary); margin-bottom: 25px; opacity: 0.9; }

        /* --- NEWS SECTION --- */
        .news-section { background-color: var(--green-light-bg); padding: 100px 0; }
        .news-card { 
            transition: all 0.3s ease;
            height: 160px; 
            border-radius: 12px;
        }
        .news-card:hover { 
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        }
        .object-fit-cover { object-fit: cover; }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-standard navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand text-success fw-bold" href="{{ route('landing') }}">
                <i class="fas fa-trash-alt me-2"></i> TrashPoint
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('fitur') }}">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('deskripsi') }}">Tentang Kami</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-success px-4">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-success px-4">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-gradient-trash text-center">
        <div class="container">
            <h1 class="hero-title mb-4">TrashPoint: Solusi Tempat Sampah Pintar</h1>
            <p class="hero-tagline mx-auto mb-0" style="max-width: 950px;">
                Mewujudkan masa depan <strong>Bekasi sebagai Smart City</strong> melalui transformasi tata kelola sampah digital yang berkelanjutan. 
                Kami mengintegrasikan teknologi IoT untuk memastikan <strong>kelangsungan ekosistem kota</strong> yang bersih, sehat, dan cerdas bagi seluruh masyarakat.
            </p>
            <div class="mt-5">
                <i class="fas fa-chevron-down fa-2x text-success animate-bounce" style="animation: bounce 2s infinite;"></i>
            </div>
        </div>
    </header>

    <section id="fitur-kontribusi" class="impact-section">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" style="font-size: 2.5rem;">Kontribusi Nyata Untuk Bekasi</h2>
            <div class="row g-4 text-center"> 
                <div class="col-md-4"> 
                    <div class="impact-card">
                        <i class="fas fa-leaf fa-4x"></i>
                        <h3 class="fw-bold text-success mb-2">1,240+</h3>
                        <p class="fw-bold text-dark mb-1">Ton Sampah Terkelola</p>
                        <p class="text-muted small">Total sampah yang berhasil dipilah dan didaur ulang secara optimal di area Bekasi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-card">
                        <i class="fas fa-users fa-4x"></i>
                        <h3 class="fw-bold text-success mb-2">8,500+</h3>
                        <p class="fw-bold text-dark mb-1">Pengguna Aktif</p>
                        <p class="text-muted small">Warga Bekasi yang telah bergabung aktif dalam ekosistem pengelolaan sampah pintar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-card">
                        <i class="fas fa-map-marker-alt fa-4x"></i>
                        <h3 class="fw-bold text-success mb-2">320+</h3>
                        <p class="fw-bold text-dark mb-1">Titik Tempat Sampah</p>
                        <p class="text-muted small">Perluasan titik akses tempat sampah pintar yang terintegrasi di seluruh fasilitas publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="berita" class="news-section">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold text-success" style="font-size: 2.3rem;">Berita & Inovasi Lingkungan Bekasi</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card news-card overflow-hidden border-0 shadow-sm">
                        <div class="row g-0 h-100">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/sampah1.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="News 1">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-bold text-success small mb-1">Pemerintah Kota Bekasi Resmikan 50 Smart Bin Baru</h5>
                                    <p class="card-text text-muted" style="font-size: 0.8rem;">Penambahan unit tempat sampah pintar ini mencakup area publik utama di Bekasi Selatan.</p>
                                    <span class="text-muted" style="font-size: 0.7rem;">15 Desember 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card news-card overflow-hidden border-0 shadow-sm">
                        <div class="row g-0 h-100">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/sampah2.webp') }}" class="img-fluid h-100 object-fit-cover" alt="News 2">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-bold text-success small mb-1">Kampanye Pilah Sampah: Poin Reward Meningkat 2x Lipat</h5>
                                    <p class="card-text text-muted" style="font-size: 0.8rem;">Dapatkan poin ekstra untuk setiap sampah organik melalui aplikasi TrashPoint.</p>
                                    <span class="text-muted" style="font-size: 0.7rem;">10 Desember 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card news-card overflow-hidden border-0 shadow-sm">
                        <div class="row g-0 h-100">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/sampah3.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="News 3">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-bold text-success small mb-1">Area Jatiasih Paling Banyak Kontribusi Sampah Organik</h5>
                                    <p class="card-text text-muted" style="font-size: 0.8rem;">Data terbaru TrashPoint menunjukkan kesadaran warga Jatiasih meningkat pesat.</p>
                                    <span class="text-muted" style="font-size: 0.7rem;">05 Desember 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card news-card overflow-hidden border-0 shadow-sm">
                        <div class="row g-0 h-100">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/sampah4.webp') }}" class="img-fluid h-100 object-fit-cover" alt="News 4">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-bold text-success small mb-1">Optimasi Rute: Efisiensi Pengangkutan Naik 15%</h5>
                                    <p class="card-text text-muted" style="font-size: 0.8rem;">Algoritma rute baru berhasil mengurangi emisi karbon dari truk pengangkut.</p>
                                    <span class="text-muted" style="font-size: 0.7rem;">01 Desember 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card news-card overflow-hidden border-0 shadow-sm">
                        <div class="row g-0 h-100">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/sampah5.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="News 5">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-bold text-success small mb-1">TrashPoint Masuk Kurikulum Sekolah Adiwiyata</h5>
                                    <p class="card-text text-muted" style="font-size: 0.8rem;">Edukasi digital sejak dini untuk membangun generasi peduli lingkungan di Bekasi.</p>
                                    <span class="text-muted" style="font-size: 0.7rem;">25 November 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card news-card overflow-hidden border-0 shadow-sm">
                        <div class="row g-0 h-100">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/sampah6.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="News 6">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-bold text-success small mb-1">Kemitraan Baru dengan Bank Sampah Hijau</h5>
                                    <p class="card-text text-muted" style="font-size: 0.8rem;">Kolaborasi ini mempercepat proses daur ulang sampah plastik di Bekasi.</p>
                                    <span class="text-muted" style="font-size: 0.7rem;">20 November 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-success px-5 py-2 fw-bold">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-5">
        <div class="container">
            <p class="mb-0 opacity-75">&copy; 2025 TrashPoint Bekasi. Solusi Pengelolaan Sampah Modern Untuk Smart City.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }
    </style>
</body>
</html>