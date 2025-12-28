@extends('layouts.app')

@section('title', 'Admin Dashboard Monitoring')

@section('content')
@php
    use App\Models\HistoryTakeOutTrash;
    use App\Models\Masyarakat;
    use App\Models\Trash;
    use App\Models\HistoryVoucher;
    use App\Models\User;
    use App\Models\Petugas;
    
    @endphp
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
                    <h2 class="fw-bold mb-0">{{HistoryTakeOutTrash::whereDate('created_at', now())->count()}}</h2>
                    <h6 class="text-uppercase small opacity-75">Input Sampah (Hari Ini)</h6>
                    {{-- <div class="mt-2 small"><i class="fas fa-arrow-up"></i>{{HistoryTakeOutTrash::whereDate('created_at', now()->subDay())->count()}} Dari Kemarin</div> --}}
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
                    <h2 class="fw-bold mb-0">{{User::where('role', 'petugas')->where('status', 'active')->count()}}</h2>
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

    <div class="card shadow-sm border-0 mb-5 bg-white">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-4 px-4 border-bottom">
            <div>
                <h5 class="fw-bold mb-0 text-success"><i class="fas fa-coins me-2"></i>Manajemen Poin & User</h5>
                <small class="text-muted">Kelola data reward harian pengguna TrashPoint</small>
            </div>

            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahUser" class="btn btn-success rounded-pill px-4">
                <i class="fas fa-user-plus me-2"></i>Tambah User
            </button>
        </div>
        
        <div class="table-responsive px-4 py-2">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-muted small">
                        <th class="border-0">NAMA PENGGUNA</th>
                        <th class="border-0">PHONE NUMBER</th>
                        <th class="border-0">ROLE</th>
                        <th class="border-0 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::all() as $user)
                    <tr class="hover-row">
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success-subtle text-success fw-bold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px;">
                                    {{ $user->idUser }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $user->username }}</div>
                                    <div class="small text-muted">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <span class="">{{ $user->phoneNumber }}</span>
                            {{-- <div class="small text-muted">POIN TERAKHIR</div> --}}
                        </td>
                        <td><span class="badge bg-light text-success border border-success px-3">{{ $user->role }}</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#editUser{{$user->idUser}}" class="btn btn-sm btn-outline-primary border-0 hover-scale"><i class="fas fa-edit"></i></button>
                                {{-- <button onclick="OpenModalTempatSampahTambah{{$user->idUser}}()" class="btn btn-sm btn-outline-primary border-0 hover-scale"><i class="fas fa-edit"></i></button> --}}
                                {{-- <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')"> --}}
                                    {{-- @csrf @method('DELETE') --}}
                                    <button onclick="hapusUser({{ $user->idUser }})" class="btn btn-sm btn-outline-danger border-0 hover-scale"><i class="fas fa-trash"></i></button>
                                {{-- </form> --}}
                            </div>
                        </td>
                    </tr>
                    
                    {{-- <div id="modalTempatSampahTambah{{$user->idUser}}" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                        <div class="bg-white p-5 rounded shadow-md w-2/6 h-max mx-5">
                            

                            <button onclick="closeModalTempatSampahTambah{{$user->idUser}}()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Tutup</button>
                        </div>
                    </div>
                    <script>
                        function OpenModalTempatSampahTambah{{$user->idUser}}() {
                            document.getElementById("modalTempatSampahTambah{{$user->idUser}}").classList.remove("hidden");
                        }

                        function closeModalTempatSampahTambah{{$user->idUser}}() {
                            document.getElementById("modalTempatSampahTambah{{$user->idUser}}").classList.add("hidden");
                        }
                    </script> --}}
                    <div class="modal fade" id="editUser{{$user->idUser}}" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addUserModalLabel">Edit User {{$user->username}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control" id="phone" name="phoneNumber" value="{{$user->phoneNumber}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <p class="">Leave blank if you do not want to change the password</p>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button onclick="editUser{{$user->idUser}}()" type="button" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    function editUser{{$user->idUser}}() {
                                    // Ambil nilai dari input
                                    const username = document.getElementById('username').value;
                                    const role = document.getElementById('role').value;
                                    const phoneNumber = document.getElementById('phone').value;
                                    const email = document.getElementById('email').value;
                                    const password = document.getElementById('password').value;
                                    // Kirim data ke server
                                    fetch('/api/users/{{$user->idUser}}', {
                                        method: 'PUT',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            username: username,
                                            role: role,
                                            phoneNumber: phoneNumber,
                                            email: email,
                                            password: password
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire(({
                                                title: 'Berhasil!',
                                                text: 'User berhasil ditambahkan.',
                                                icon: 'success'
                                            })).then(() => {
                                                location.reload();
                                                });
                                                
                                        } else {
                                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menambahkan user.', 'error');
                                        }
                                    })
                                    .catch(error => {
                                        window.location.reload();
                                    });
                                }
                            </script>
                    @endforeach
                </tbody>
                <script>
                    function hapusUser(idUser) {
                        Swal.fire({
                            title: 'Yakin menghapus user ini?',
                            text: "Data yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch('/api/users/' + idUser, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire(
                                            'Dihapus!',
                                            'User telah dihapus.',
                                            'success'
                                        ).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus user.', 'error');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Gagal!', 'Terjadi kesalahan koneksi.', 'error');
                                });
                            }
                        });
                    }
                </script>
            </table>
        </div>
    </div>

    <div class="flex flex-row gap-4 mb-5">
    <div class="col-md-8 w-7/12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header card-header-custom"><i class="fas fa-map-marker-alt me-2"></i> Peta Lokasi & Status Real-time</div>
                <div class="card-body">
                    <div style="height: 400px; background-color: #f8f9fa; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center;">
                        @php
                        $dataTempatSampah = Trash::get()->toArray();
                        // dd($dataTempatSampah);
                        @endphp
                        <div id="map" class="w-full h-96 rounded-md mt-4"></div>
                        <script>
                                // Inisialisasi peta
                                var map = L.map('map').setView([-6.24227, 106.99550], 13); // Koordinat default (Jakarta)

                                // Tambahkan tile layer dari OpenStreetMap
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '© OpenStreetMap contributors'
                                }).addTo(map);

                                var marker;

                                // Event ketika user klik peta
                                map.on('click', function(e) {
                                    var lat = e.latlng.lat;
                                    var lng = e.latlng.lng;

                                    // Simpan ke input hidden
                                    document.getElementById('latitude').value = lat;
                                    document.getElementById('longitude').value = lng;

                                    // Hapus marker sebelumnya jika ada
                                    if (marker) {
                                        map.removeLayer(marker);
                                    }

                                    // Tambahkan marker baru
                                    marker = L.marker([lat, lng]).addTo(map)
                                        .bindPopup("Lokasi dipilih: " + lat.toFixed(5) + ", " + lng.toFixed(5)).openPopup();
                                });

                                document.querySelector('.leaflet-control-zoom').remove();
                                document.querySelector('.leaflet-control-attribution').remove();
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 w-4/12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header card-header-custom"><i class="fas fa-newspaper me-2"></i> History buang sampah</div>
                <div class="card-body h-[430px] overflow-y-scroll">
                    <div class="flex flex-col w-full mt-5 gap-2">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="text" name="idTrash" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Id Tempat Sampah" hidden>
            <input type="text" name="province" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Provinsi Tempat Sampah">
            <input type="text" name="city" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Kota Tempat Sampah">
            <input type="text" name="roadAddress" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Jalan Tempat Sampah">
            <input type="text" hidden value="empty" name="statusTempatSampah" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Status Tempat Sampah">
            <button onclick="tambahTempatSampah()" type="submit" name="submitEditTempatsampah" value="" class="bg-zinc-700 textWhite rounded text-white p-2 w-full">Tambah</button>
            <script>
                function tambahTempatSampah() {
                    console.log("tambahTempatSampah dijalankan");
                    const latitude = document.getElementById('latitude').value;
                    const longitude = document.getElementById('longitude').value;
                    const idTrash = document.querySelector('input[name="idTrash"]').value;
                    const province = document.querySelector('input[name="province"]').value;
                    const city = document.querySelector('input[name="city"]').value;
                    const roadAddress = document.querySelector('input[name="roadAddress"]').value;
                    const statusTempatSampah = document.querySelector('input[name="statusTempatSampah"]').value;
                    console.log(`Latitude: ${latitude}, Longitude: ${longitude}, Province: ${province}, City: ${city}, Road Address: ${roadAddress}, Status: ${statusTempatSampah}`);
                    Swal.fire(({
                        title: 'Yakin menambahkan tempat sampah ini?',
                        text: `Lokasi: ${latitude}, ${longitude}`,
                    })).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/api/trash-schedule/create-trash-schedule', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            latitude: latitude,
                            longitude: longitude,
                            // idTrash: idTrash,
                            province: province,
                            city: city,
                            roadAddress: roadAddress,
                            status: statusTempatSampah
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(({
                                title: 'Berhasil!',
                                text: 'Tempat sampah berhasil ditambahkan.',
                                icon: 'success'
                            })).then(() => {
                                location.reload();
                                });
                        } else {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menambahkan tempat sampah.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Gagal!', 'Terjadi kesalahan jaringan.', 'error');
                    });
                        }
                    });
                    
                }
            </script>
        </div>
                </div>
            </div>
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

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addUserModalLabel">Tambah User Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="masyarakat">Masyarakat</option>
                        <option value="petugas">Petugas</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone" name="phoneNumber" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="tambahUser()" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function tambahUser() {
                    // Ambil nilai dari input
                    const username = document.getElementById('username').value;
                    const role = document.getElementById('role').value;
                    const phoneNumber = document.getElementById('phone').value;
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;

                    // Kirim data ke server
                    fetch('/api/users', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            username: username,
                            role: role,
                            phoneNumber: phoneNumber,
                            email: email,
                            password: password
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(({
                                title: 'Berhasil!',
                                text: 'User berhasil ditambahkan.',
                                icon: 'success'
                            })).then(() => {
                                location.reload();
                                });
                                
                        } else {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menambahkan user.', 'error');
                        }
                    })
                    .catch(error => {
                        window.location.reload();
                    });
                }
            </script>

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