<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashPoint - Tentang Kami</title>
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

        /* --- NAVBAR (IDENTIK) --- */
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

        /* --- BUTTONS (IDENTIK) --- */
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

        /* --- HEADER --- */
        .bg-gradient-trash {
            background-color: white; 
            background-image: radial-gradient(at 10% 10%, #e6ffe6 0%, transparent 50%),
                              radial-gradient(at 90% 90%, #f0fff0 0%, transparent 50%);
            padding: 80px 0;
        }

        /* --- CONTENT BOXES --- */
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
            transform: scale(1.01);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon-wrapper {
            width: 50px;
            height: 50px;
            background-color: var(--green-light-bg);
            color: var(--green-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1.25rem;
        }

        h2 { font-weight: 800; }
        .text-success-custom { color: var(--green-primary); }
        p { color: var(--text-secondary); line-height: 1.8; }

        /* --- TEAM STYLE --- */
        .team-card {
            text-align: center;
            padding: 20px;
        }
        .team-title { font-weight: bold; margin-bottom: 5px; color: var(--text-dark); }
        .team-role { color: var(--green-primary); font-size: 0.9rem; font-weight: 600; }
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('fitur') }}">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('deskripsi') }}">Tentang Kami</a></li>
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
            <h1 class="display-4 fw-bold text-dark mb-3">Mengenal Lebih Dekat TrashPoint</h1>
            <p class="lead mx-auto text-secondary mb-4" style="max-width: 800px;">Visi kami adalah menciptakan ekosistem pengelolaan sampah yang cerdas, efisien, dan berkelanjutan bagi masyarakat Bekasi.</p>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <p>TrashPoint didirikan dengan misi untuk mengatasi tantangan pengelolaan sampah perkotaan yang semakin kompleks. Kami percaya bahwa teknologi <strong>Internet of Things (IoT)</strong> adalah kunci untuk mengubah masalah sampah menjadi peluang efisiensi dan partisipasi masyarakat.</p>
                </div>
            </div>
        </div>
    </header>

    <section class="container py-5">
        
        <h2 class="text-success-custom mb-4 mt-2">Konsep Inti Kami</h2>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="feature-detail-box">
                    <div class="feature-icon-wrapper shadow-sm"><i class="fas fa-microchip"></i></div>
                    <h5 class="fw-bold">Teknologi IoT</h5>
                    <p class="small mb-0">Setiap unit tempat sampah dilengkapi dengan sensor yang memantau tingkat volume, berat, dan bahkan suhu secara real-time sebagai pondasi keputusan operasional.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-detail-box">
                    <div class="feature-icon-wrapper shadow-sm"><i class="fas fa-chart-bar"></i></div>
                    <h5 class="fw-bold">Analisis Data Cerdas</h5>
                    <p class="small mb-0">Data yang terkumpul diolah menggunakan algoritma untuk memprediksi kapan tempat sampah penuh dan menyusun rute pengangkutan yang paling optimal.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-detail-box">
                    <div class="feature-icon-wrapper shadow-sm"><i class="fas fa-leaf"></i></div>
                    <h5 class="fw-bold">Dampak Lingkungan</h5>
                    <p class="small mb-0">Optimasi rute secara signifikan mengurangi jarak tempuh armada, menurunkan konsumsi bahan bakar, dan menekan emisi CO2 di wilayah Bekasi.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-detail-box">
                    <div class="feature-icon-wrapper shadow-sm"><i class="fas fa-users"></i></div>
                    <h5 class="fw-bold">Partisipasi Masyarakat</h5>
                    <p class="small mb-0">Sistem gamifikasi mendorong warga untuk membuang sampah pada tempatnya, menciptakan kebiasaan positif dan bertanggung jawab melalui reward.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="feature-detail-box" style="border-left-color: #ffc107;">
                    <h2 class="text-dark mb-3"><i class="fas fa-eye text-warning me-2"></i>Visi Kami</h2>
                    <p>Menjadi pemimpin teknologi pengelolaan sampah berbasis IoT di Indonesia, menciptakan kota cerdas yang bebas dari masalah sampah dan mendukung keberlanjutan lingkungan global, dimulai dari Bekasi.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-detail-box" style="border-left-color: #0d6efd;">
                    <h2 class="text-dark mb-3"><i class="fas fa-bullseye text-primary me-2"></i>Misi Kami</h2>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Mengembangkan Smart Bin yang akurat dan efisien.</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Mengoptimalkan rute untuk mengurangi biaya dan emisi.</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Mendorong partisipasi publik melalui sistem reward.</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Menyediakan data transparan bagi pemerintah kota.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="py-4">
            <h2 class="text-center fw-bold mb-5">Tim Pengembang Kami</h2>
            <div class="row">
                <div class="col-md-4 team-card">
                    <h4 class="team-title">Ariq Ahmad Nayaka</h4>
                    <p class="team-role">Chief Executive Officer</p>
                </div>
                <div class="col-md-4 team-card">
                    <h4 class="team-title">Kamilah Dzakiyyah Azzahra</h4>
                    <p class="team-role">Chief Technology Officer</p>
                </div>
                <div class="col-md-4 team-card">
                    <h4 class="team-title">Andi Dela Rezky</h4>
                    <p class="team-role">Lead Developer & IoT Specialist</p>
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