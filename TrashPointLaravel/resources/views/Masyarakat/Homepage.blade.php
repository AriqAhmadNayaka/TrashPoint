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
    @php
    use App\Models\HistoryTakeOutTrash;
    use App\Models\Masyarakat;
    use App\Models\Trash;
    use App\Models\HistoryVoucher;
    @endphp
    <h1 class="mb-4" style="color: var(--trashpoint-dark-green);"><strong>Selamat datang!</strong></h1>
    
    <p class="lead mb-5">
        Halo, <strong>{{ Auth::user()->username }}</strong>. 
        Mari bersama-sama jaga lingkungan kita. Dengan buang sampah pada tempatnya, Anda berkontribusi pada kebersihan Kota Bekasi.
    </p>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalDailyCollection">
                <div class="card-body">
                    <h5 class="card-title">Poin</h5>
                    <p class="card-text display-4" style="color: var(--trashpoint-soft-green);">{{Masyarakat::where('idUser', Auth::user()->idUser)->first()->points}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalTotalBins">
                <div class="card-body">
                    <h5 class="card-title">Total Unit Terdaftar</h5>
                    <p class="card-text display-4">{{ \App\Models\Trash::count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalCriticalStatus">
                <div class="card-body">
                    <h5 class="card-title text-danger">Unit Kritis (Penuh)</h5>
                    <p class="card-text display-4 text-danger">{{ \App\Models\Trash::where('status', 'full')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card" data-bs-toggle="modal" data-bs-target="#modalSensorError">
                <div class="card-body">
                    <h5 class="card-title text-warning">Sensor Error</h5>
                    <p class="card-text display-4 text-warning">{{ \App\Models\Trash::where('status', 'inactive')->count() }}</p>
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
                        <div id="map" class="w-full h-full rounded-md border border-none"></div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header card-header-custom"><i class="fas fa-newspaper me-2"></i> History buang sampah</div>
                <div class="card-body h-[430px] overflow-y-scroll">
                    <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kota</th>
                        <th>Jalan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                @php
                    $idMasyarakat = Masyarakat::where('idUser', Auth::user()->idUser)->first()->idMasyarakat;
                    $HistoryTakeOutTrash = HistoryTakeOutTrash::where('idMasyarakat', $idMasyarakat)->get();

                @endphp
                <tbody>
                    @foreach ($HistoryTakeOutTrash as $history)
                    <tr>
                        <td>TS-{{$history->idTrash}}</td>
                        <td>{{Trash::where('idTrash', $history->idTrash)->first()->city}}</td>
                        <td>{{Trash::where('idTrash', $history->idTrash)->first()->roadAddress}}</td>
                        <td>{{$history->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4">
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
        </div> --}}
    </div>

    <div class="flex flex-row gap-2">
        <div class="card mb-4 shadow-sm w-full">
            <div class="card-header card-header-custom"><i class="fas fa-exclamation-triangle me-2"></i> Tukar Voucher</div>
            <div class="card-body h-[430px] overflow-y-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Voucher</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                        use App\Models\Voucher;
                        $vouchers = Voucher::all();
                    @endphp
                    <tbody>
                        @foreach ($vouchers as $voucher)
                        <tr>
                            <td>{{$voucher->voucherName}}</td>
                            <td>{{$voucher->price}}</td>
                            <td>
                                <button onclick="btnTukarVoucher({{$voucher->idVoucher}})" class="btn btn-primary btn-sm">Tukar</button>
                            </td>
                        </tr>
                        @endforeach
                            <script>
                                function btnTukarVoucher(idVoucherSelect) {
                                    Swal.fire({
                                        title: 'Konfirmasi Tukar Voucher',
                                        text: "Apakah Anda yakin ingin menukar voucher ini?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, tukar sekarang!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            fetch('/api/users/redeem-vouchers/{{ Auth::user()->idUser }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json'
                                                },
                                                body: JSON.stringify({
                                                    idVoucher: idVoucherSelect
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    Swal.fire(
                                                        'Berhasil!',
                                                        'Voucher berhasil ditukar.',
                                                        'success'
                                                    ).then(() => {
                                                        window.location.reload();
                                                    });
                                                } else {
                                                    Swal.fire(
                                                        'Gagal!',
                                                        data.message || 'Terjadi kesalahan.',
                                                        'error'
                                                    );
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                Swal.fire(
                                                    'Error!',
                                                    'Terjadi kesalahan koneksi.',
                                                    'error'
                                                );
                                            });
                                        }
                                    });
                                }
                                </script>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-4 shadow-sm w-full">
            <div class="card-header card-header-custom"><i class="fas fa-exclamation-triangle me-2"></i> History Tukar Voucher</div>
            <div class="card-body h-[430px] overflow-y-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Voucher</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    @php
                    $idMasyarakat = Masyarakat::where('idUser', Auth::user()->idUser)->first()->idMasyarakat;
                    $HistoryVoucher = HistoryVoucher::where('idMasyarakat', $idMasyarakat)->get();
                    @endphp
                    <tbody>
                        @foreach ($HistoryVoucher as $history)
                        <tr>
                            <td>{{Voucher::where('idVoucher', $history->idVoucher)->first()->voucherName}}</td>
                            <td>{{Voucher::where('idVoucher', $history->idVoucher)->first()->price}}</td>
                            <td>{{Voucher::where('idVoucher', $history->idVoucher)->first()->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @php
    $dataTempatSampah = Trash::where('status', '!=', 'full')->get()->toArray();
    // dd($dataTempatSampah);
    @endphp
    <script>
        var map = L.map('map').setView([-6.234, 106.979], 13); // Koordinat pusat Bekasi
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            zoomControl: false,
        }).addTo(map);

        var locations = [
            <?php 
            foreach ($dataTempatSampah as $row) { ?> {
                    idTempatSampah: <?= $row["idTrash"] ?>,
                    lat: <?= $row["latitude"] ?>,
                    lon: <?= $row["longitude"] ?>,
                    name: "<?= $row["city"] . ", " . $row["roadAddress"] ?>",
                    status: "<?= $row["status"] ?>"
                },
            <?php } ?>
        ];

        locations.forEach(function(location) {

            var marker = L.marker([location.lat, location.lon]).addTo(map);
            marker.on('click', function() {
                Swal.fire({
                    title: "Tempat Sampah",
                    text: "Alamat: " + location.name,
                    confirmButtonText: 'Buang Sampah',
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/api/users/take-out-trash/{{ Auth::user()->idUser }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                idTrash: location.idTempatSampah
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Sampah berhasil dibuang. Poin Anda bertambah.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: data.message || "Terjadi kesalahan.",
                                    icon: "error"
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: "Error!",
                                text: "Terjadi kesalahan koneksi.",
                                icon: "error"
                            });
                        });
                    }
                });
            });

        });

        document.querySelector('.leaflet-control-zoom').remove();
        document.querySelector('.leaflet-control-attribution').remove();
    </script>
@endsection