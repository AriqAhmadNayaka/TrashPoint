<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashPoint - Detail Fitur</title>
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

        /* --- NAVBAR (IDENTIK LANDING) --- */
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

        /* --- BUTTONS (IDENTIK LANDING) --- */
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

        /* --- FEATURE CONTENT --- */
        .bg-gradient-trash {
            background-color: white; 
            background-image: radial-gradient(at 10% 10%, #e6ffe6 0%, transparent 50%),
                              radial-gradient(at 90% 90%, #f0fff0 0%, transparent 50%);
            padding: 80px 0;
        }

        .feature-detail-box {
            padding: 40px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            border-left: 8px solid var(--green-primary);
            transition: all 0.4s ease;
            height: 100%;
        }
        .feature-detail-box:hover {
            transform: scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon-wrapper {
            width: 60px;
            height: 60px;
            background-color: var(--green-light-bg);
            color: var(--green-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        h2 { font-weight: 800; }
        p { color: var(--text-secondary); line-height: 1.8; }
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('fitur') }}">Fitur</a></li>
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
            <h1 class="display-4 fw-bold text-dark mb-3">Fitur Unggulan TrashPoint</h1>
            <p class="lead mx-auto text-secondary" style="max-width: 700px;">Eksplorasi teknologi cerdas kami yang dirancang khusus untuk memodernisasi pengelolaan sampah di Bekasi.</p>
        </div>
    </header>

    <section class="container py-5">
        <div class="row g-5">
            
            <div class="col-12">
                <div class="feature-detail-box">
                    <div class="d-md-flex align-items-start gap-4">
                        <div class="feature-icon-wrapper shadow-sm">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <h2 class="text-success mb-3">Pemantauan Real-time</h2>
                            <p>Sistem ini menggunakan sensor canggih di setiap unit tempat sampah. Data kapasitas, suhu, dan lokasi dikirimkan secara otomatis ke Dashboard Administrator setiap saat.</p>
                            <p class="mb-0">Hal ini memungkinkan operator mengetahui status setiap unit tanpa pengecekan fisik, menghemat waktu dan sumber daya, serta mendukung pengambilan keputusan yang cepat dan pengelolaan sampah yang optimal bagi pemerintah kota.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="feature-detail-box">
                    <div class="d-md-flex align-items-start gap-4">
                        <div class="feature-icon-wrapper shadow-sm">
                            <i class="fas fa-gift"></i>
                        </div>
                        <div>
                            <h2 class="text-success mb-3">Sistem Poin Berhadiah</h2>
                            <p>Mendorong partisipasi masyarakat melalui mekanisme <strong>Gamifikasi</strong>. Pengguna cukup memindai QR code unik yang ada di setiap Smart Bin saat membuang sampah, dan poin akan langsung tercatat di akun digital mereka.</p>
                            <p class="mb-0">Setiap aktivitas pembuangan sampah yang bertanggung jawab akan menghasilkan poin yang dapat ditukarkan dengan berbagai hadiah menarik, voucher, atau saldo digital, yang mendukung gaya hidup hijau di tengah masyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="feature-detail-box">
                    <div class="d-md-flex align-items-start gap-4">
                        <div class="feature-icon-wrapper shadow-sm">
                            <i class="fas fa-route"></i>
                        </div>
                        <div>
                            <h2 class="text-success mb-3">Optimasi Rute Pengangkutan</h2>
                            <p>Algoritma pintar kami menganalisis data kapasitas sampah secara kolektif. Truk pengangkut tidak lagi berkeliling secara acak, melainkan mengikuti rute dinamis yang hanya mengunjungi titik-titik yang sudah hampir penuh.</p>
                            <p class="mb-0">Hasilnya? Pengurangan jarak tempuh armada secara signifikan, penghematan anggaran bahan bakar, dan penurunan emisi CO2 yang membuat lingkungan Bekasi menjadi lebih sehat dan efisien.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-5">
        <div class="container">
            <p class="mb-0 opacity-75">&copy; 2025 TrashPoint Bekasi. Solusi Pengelolaan Sampah Modern Untuk Smart City.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>