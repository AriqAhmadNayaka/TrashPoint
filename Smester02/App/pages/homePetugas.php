<?php require_once("../templates/header.php");
if (isset($_GET["message"])) {
    if ($_GET["message"] == "successSetStatusJadwalPengangkutan") {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Status Jadwal Pengangkutan Berhasil Diperbarui',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$url/App/pages/homePetugas.php';
                }
            });
        </script>";
    } else if ($_GET["message"] == "failedSetStatusJadwalPengangkutan") {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Status Jadwal Pengangkutan Gagal Diperbarui',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$url/App/pages/homePetugas.php';
                }
            });
        </script>";
    }
}
?>
<div class="w-full h-max flex flex-col px-5 pt-5 pb-2">
    <div class="w-full h-max flex flex-row justify-between items-center">
        <h1 class="">Tpoint</h1>
        <h1 class="">Petugas</h1>
        <!-- <img src="../../assets/images/menu.png" style="height: 25px;" alt=""> -->
        <!-- <img src="../../assets/images/trashpoint   .png" style="height: 25px;" alt=""> -->
        <!-- <img src="../../assets/images/notification.png" style="height: 25px;" alt=""> -->
        <!-- <div class="rounded-full bg-gray-900 p-4"></div> -->
        <button class="bg-red-200 text-white rounded-md p-2" onclick="logout()">Logout</button>
        <script>
            function logout() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan keluar dari akun ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, keluar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?= $url ?>/Api/routes.php?action=logout";
                    }
                })
            }
        </script>
    </div>
    <br>
    <hr>
</div>
<div class="w-full flex flex-col px-5 mt-5">
    <h1>Tugas</h1>
    <hr>
    <div class="w-full flex flex-col gap-2 rounded mt-2 overflow-y-scroll h-max max-h-96">
        <?php $jadwalPengangkutanData = $jadwalPengangkutan->getByIdPetugas($_SESSION["userData"]["idUser"]);
        if ($jadwalPengangkutanData["status"] == "success") {
            // var_dump($jadwalPengangkutanData);
            foreach ($jadwalPengangkutanData["data"] as $data) { ?>
                <div class="w-full flex flex-col justify-between p-2 border h-max border-zinc-700 rounded">
                    <?php if ($data["statusJadwalPengangkutan"] != "assigned") {
                        $dataTempatSampah = $detailPengangkutan->getByIdJadwalPengangkutan($data["idJadwalPengangkutan"]);
                        if ($dataTempatSampah["status"] != false && $data["statusJadwalPengangkutan"] != "need accept") { ?>
                            <div id="map<?= $data['idJadwalPengangkutan'] ?>" class="mb-3 w-full h-56 rounded-md border border-zinc-700"></div>

                            <!-- <script>
                                var map = L.map("map<?= $data["idJadwalPengangkutan"] ?>").setView([-6.234, 106.979], 13); // Koordinat pusat Bekasi

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    zoomControl: false,
                                }).addTo(map);

                                var locations = [
                                    <?php $dataTempatSampah = $detailPengangkutan->getByIdJadwalPengangkutan($data["idJadwalPengangkutan"]);
                                    foreach ($dataTempatSampah["data"] as $row) { ?> {
                                            idTempatSampah: <?= $row["idTempatSampah"] ?>,
                                            lat: <?= $row["lat"] ?>,
                                            lon: <?= $row["lon"] ?>,
                                            name: "<?= $row["kotaTempatSampah"] . ", " . $row["jalanTempatSampah"] ?>",
                                            status: "<?= $row["statusTempatSampah"] ?>"
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
                                                ambilSampah(location.idTempatSampah);
                                            }
                                        });
                                    });

                                });

                                document.querySelector('.leaflet-control-zoom').remove();
                                document.querySelector('.leaflet-control-attribution').remove();
                            </script> -->

                            <!-- <script>
                                // Pastikan Leaflet dan L.Routing Machine sudah terload
                                if (typeof L === 'undefined') {
                                    console.error('Leaflet.js not loaded');
                                }
                                if (typeof L.Routing === 'undefined') {
                                    console.error('Leaflet Routing Machine not loaded');
                                }

                                var map = L.map("map<?= $data["idJadwalPengangkutan"] ?>").setView([-6.234, 106.979], 13);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    zoomControl: false,
                                }).addTo(map);

                                var locations = [
                                    <?php $dataTempatSampah = $detailPengangkutan->getByIdJadwalPengangkutan($data["idJadwalPengangkutan"]);
                                    foreach ($dataTempatSampah["data"] as $row) { ?> {
                                            idTempatSampah: <?= $row["idTempatSampah"] ?>,
                                            lat: <?= $row["lat"] ?>,
                                            lon: <?= $row["lon"] ?>,
                                            name: "<?= $row["kotaTempatSampah"] . ", " . $row["jalanTempatSampah"] ?>",
                                            status: "<?= $row["statusTempatSampah"] ?>"
                                        },
                                    <?php } ?>
                                ];

                                // Pastikan ada minimal 2 lokasi untuk membuat rute
                                if (locations.length >= 2) {
                                    var waypoints = locations.map(function(location) {
                                        return L.latLng(location.lat, location.lon);
                                    });

                                    // Gunakan routing machine dengan error handling
                                    try {
                                        L.Routing.control({
                                            waypoints: waypoints,
                                            routeWhileDragging: true,
                                            show: false,
                                            lineOptions: {
                                                styles: [{
                                                    color: '#3b82f6',
                                                    opacity: 0.7,
                                                    weight: 5
                                                }]
                                            },
                                            addWaypoints: false,
                                            draggableWaypoints: false,
                                            fitSelectedRoutes: true,
                                            createMarker: function(i, waypoint, n) {
                                                if (i === 0 || i === waypoints.length - 1) {
                                                    return L.marker(waypoint.latLng, {
                                                        icon: L.divIcon({
                                                            className: i === 0 ? 'start-marker' : 'end-marker',
                                                            html: i === 0 ? '🟢' : '🔴',
                                                            iconSize: [24, 24]
                                                        })
                                                    });
                                                }
                                                return null;
                                            }
                                        }).addTo(map);
                                    } catch (e) {
                                        console.error('Routing error:', e);
                                    }
                                }

                                // Tambahkan marker untuk semua lokasi
                                locations.forEach(function(location) {
                                    var marker = L.marker([location.lat, location.lon], {
                                        icon: L.divIcon({
                                            className: 'trash-marker',
                                            html: '🗑️',
                                            iconSize: [24, 24]
                                        })
                                    }).addTo(map);

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
                                                ambilSampah(location.idTempatSampah);
                                            }
                                        });
                                    });
                                });

                                // Fit bounds jika ada lokasi
                                if (locations.length > 0) {
                                    var bounds = L.latLngBounds(locations.map(loc => [loc.lat, loc.lon]));
                                    map.fitBounds(bounds, {
                                        padding: [50, 50]
                                    });
                                }

                                document.querySelector('.leaflet-control-zoom')?.remove();
                                document.querySelector('.leaflet-control-attribution')?.remove();
                            </script> -->

                            <script>
                                // Fungsi untuk menghitung jarak antara dua titik
                                function calculateDistance(lat1, lon1, lat2, lon2) {
                                    const R = 6371; // Radius bumi dalam km
                                    const dLat = (lat2 - lat1) * Math.PI / 180;
                                    const dLon = (lon2 - lon1) * Math.PI / 180;
                                    const a =
                                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                                        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                                    return R * c; // Jarak dalam km
                                }

                                // Fungsi untuk mengoptimalkan rute dengan nearest neighbor algorithm
                                function optimizeRoute(locations) {
                                    if (locations.length < 2) return locations;

                                    let optimized = [];
                                    let unvisited = [...locations];

                                    // Mulai dari titik pertama (bisa diganti dengan titik depot jika ada)
                                    let current = unvisited.shift();
                                    optimized.push(current);

                                    while (unvisited.length > 0) {
                                        // Cari titik terdekat dari current point
                                        let nearestIndex = 0;
                                        let nearestDistance = calculateDistance(
                                            current.lat, current.lon,
                                            unvisited[0].lat, unvisited[0].lon
                                        );

                                        for (let i = 1; i < unvisited.length; i++) {
                                            const distance = calculateDistance(
                                                current.lat, current.lon,
                                                unvisited[i].lat, unvisited[i].lon
                                            );
                                            if (distance < nearestDistance) {
                                                nearestDistance = distance;
                                                nearestIndex = i;
                                            }
                                        }

                                        current = unvisited.splice(nearestIndex, 1)[0];
                                        optimized.push(current);
                                    }

                                    return optimized;
                                }

                                var map = L.map("map<?= $data["idJadwalPengangkutan"] ?>").setView([-6.234, 106.979], 13);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    zoomControl: false,
                                }).addTo(map);

                                var locations = [
                                    <?php $dataTempatSampah = $detailPengangkutan->getByIdJadwalPengangkutan($data["idJadwalPengangkutan"]);
                                    foreach ($dataTempatSampah["data"] as $row) { ?> {
                                            idTempatSampah: <?= $row["idTempatSampah"] ?>,
                                            lat: <?= $row["lat"] ?>,
                                            lon: <?= $row["lon"] ?>,
                                            name: "<?= $row["kotaTempatSampah"] . ", " . $row["jalanTempatSampah"] ?>",
                                            status: "<?= $row["statusTempatSampah"] ?>"
                                        },
                                    <?php } ?>
                                ];

                                // Optimalkan rute
                                var optimizedLocations = optimizeRoute(locations);

                                // Buat waypoints dari lokasi yang sudah dioptimalkan
                                var waypoints = optimizedLocations.map(function(location) {
                                    return L.latLng(location.lat, location.lon);
                                });

                                // Tambahkan routing jika ada minimal 2 waypoint
                                if (waypoints.length >= 2) {
                                    try {
                                        L.Routing.control({
                                            waypoints: waypoints,
                                            routeWhileDragging: false,
                                            show: false,
                                            lineOptions: {
                                                styles: [{
                                                    color: '#3b82f6',
                                                    opacity: 0.7,
                                                    weight: 5
                                                }]
                                            },
                                            addWaypoints: false,
                                            draggableWaypoints: false,
                                            fitSelectedRoutes: true,
                                            createMarker: function(i, waypoint, n) {
                                                // Hanya buat marker untuk titik awal dan akhir
                                                if (i === 0 || i === waypoints.length - 1) {
                                                    return L.marker(waypoint.latLng, {
                                                        icon: L.divIcon({
                                                            className: i === 0 ? 'start-marker' : 'end-marker',
                                                            html: i === 0 ? '🟢 Start' : '🔴 End',
                                                            iconSize: [30, 30]
                                                        })
                                                    });
                                                }
                                                return null;
                                            }
                                        }).addTo(map);
                                    } catch (e) {
                                        console.error('Routing error:', e);
                                    }
                                }

                                // Tambahkan marker untuk semua lokasi dengan nomor urut
                                optimizedLocations.forEach(function(location, index) {
                                    var marker = L.marker([location.lat, location.lon], {
                                        icon: L.divIcon({
                                            className: 'trash-marker',
                                            html: `<div style="background:#3b82f6;color:white;border-radius:50%;width:24px;height:24px;display:flex;align-items:center;justify-content:center">${index+1}</div>`,
                                            iconSize: [24, 24]
                                        })
                                    }).addTo(map);

                                    marker.bindTooltip(`#${index+1}: ${location.name}`, {
                                        permanent: false,
                                        direction: 'top'
                                    });

                                    marker.on('click', function() {
                                        Swal.fire({
                                            title: `Tempat Sampah #${index+1}`,
                                            text: "Alamat: " + location.name,
                                            confirmButtonText: 'Buang Sampah',
                                            confirmButtonColor: '#3085d6',
                                            showCancelButton: true,
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                ambilSampah(location.idTempatSampah);
                                            }
                                        });
                                    });
                                });

                                // Fit bounds untuk menampilkan semua lokasi
                                if (locations.length > 0) {
                                    var bounds = L.latLngBounds(locations.map(loc => [loc.lat, loc.lon]));
                                    map.fitBounds(bounds, {
                                        padding: [50, 50]
                                    });
                                }

                                document.querySelector('.leaflet-control-zoom')?.remove();
                                document.querySelector('.leaflet-control-attribution')?.remove();
                            </script>

                            <style>
                                .start-marker,
                                .end-marker {
                                    background: transparent;
                                    border: none;
                                }

                                .trash-marker {
                                    background: transparent;
                                    border: none;
                                }

                                .leaflet-routing-container {
                                    display: none;
                                }
                            </style>
                    <?php }
                    } ?>
                    <div class="w-full flex flex-row justify-between">
                        <div>
                            <p class="text-sm">Petugas: <?= $data["petugasUsername"] ?></p>
                            <p class="text-sm">Pemberi tugas: <?= $data["adminUsername"] ?></p>
                        </div>
                        <div>
                            <p class="text-sm"><?= $data["tglJadwalPengangkutan"] ?></p>
                            <p class="text-sm">Status: <?= $data["statusJadwalPengangkutan"] ?></p>
                        </div>
                    </div>
                    <div class="w-full flex gap-2 flex-col">
                        <?php if ($data["statusJadwalPengangkutan"] == "assigned") { ?>
                            <button class="bg-green-500 text-white rounded p-2" onclick="window.location.href='<?= $url ?>/Api/routes.php?action=setStatusJadwalPengangkutan&idJadwalPengangkutan=<?= $data['idJadwalPengangkutan'] ?>&status=on%20progress'">Ambil Tugas</button>
                        <?php } else if ($data["statusJadwalPengangkutan"] == "on progress") { ?>
                            <!-- <button onclick="openDetailPengangkutanId<?= $data['idJadwalPengangkutan'] ?>()" class="bg-yellow-500 text-white rounded p-2">Detail</button> -->
                            <button class="bg-yellow-500 text-white rounded p-2" onclick="window.location.href='<?= $url ?>/Api/routes.php?action=setStatusJadwalPengangkutan&idJadwalPengangkutan=<?= $data['idJadwalPengangkutan'] ?>&status=need%20accept'">Selesaikan Tugas</button>
                        <?php } else if ($data["statusJadwalPengangkutan"] == "need accept") { ?>
                            <!-- <button class="bg-blue-500 text-white rounded p-2" onclick="window.location.href='<?= $url ?>/Api/routes.php?action=setStatusJadwalPengangkutan&idJadwalPengangkutan=<?= $data['idJadwalPengangkutan'] ?>&status='">Tugas Perlu Diterima</button> -->
                            <p class="text-center mt-3">Tunggu konfirmasi</p>
                        <?php } ?>
                    </div>
                    <div id="detailPengangkutanId<?= $data['idJadwalPengangkutan'] ?>" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                        <script>
                            function openDetailPengangkutanId<?= $data['idJadwalPengangkutan'] ?>() {
                                document.getElementById("detailPengangkutanId<?= $data['idJadwalPengangkutan'] ?>").classList.remove("hidden");
                            }

                            function closeDetailPengangkutanId<?= $data['idJadwalPengangkutan'] ?>() {
                                document.getElementById("detailPengangkutanId<?= $data['idJadwalPengangkutan'] ?>").classList.add("hidden");
                            }

                            function ambilSampah(id) {
                                Swal.fire({
                                    title: 'Ambil Sampah',
                                    text: 'Apakah anda yakin ingin mengambil sampah?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya',
                                    cancelButtonText: 'Tidak'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '<?= $url ?>/Api/routes.php?action=ambilSampah&idJadwalPengangkutan=<?= $data['idJadwalPengangkutan'] ?>&idTempatSampah=' + id + '&statusTempatSampah=active';
                                    }
                                });
                            }
                        </script>
                        <div class="bg-white p-5 flex flex-col gap-2 w-full rounded shadow-md h-max mx-5">
                            <div class="w-full h-max flex flex-col gap-1">


                            </div>
                            <!-- <?php $detailPengangkutanData = $detailPengangkutan->getByIdJadwalPengangkutan($data["idJadwalPengangkutan"]);
                                    foreach ($detailPengangkutanData["data"] as $detail) { ?>
                                <div class="w-full flex flex-row justify-between gap-2 border border-zinc-700 rounded p-2">
                                    <div class="w-full flex flex-col">
                                        <p class="text-sm">ID Tempat Sampah: <?= $detail["idTempatSampah"] ?></p>
                                        <p class="text-sm">Kota Tempat Sampah: <?= $detail["kotaTempatSampah"] ?></p>
                                        <p class="text-sm">Jalan Tempat Sampah: <?= $detail["jalanTempatSampah"] ?></p>
                                        <p class="text-sm">Status: <?= $detail["statusTempatSampah"] ?></p>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <?php if ($detail["statusTempatSampah"] != "active") { ?>
                                            <button class="bg-green-500 text-white rounded p-2" onclick="ambilSampah(<?= $detail['idTempatSampah'] ?>)">Ambil sampah</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?> -->


                            <button onclick="closeDetailPengangkutanId<?= $data['idJadwalPengangkutan'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Tutup</button>
                        </div>
                    </div>
                </div>
        <?php }
        } else {
            echo "<div class='w-full flex flex-col p-2'>
                        <h1 class='text-lg font-bold'>Tidak ada tugas</h1>
                      </div>";
        }
        ?>
    </div>
</div>

<div class="w-full flex flex-col px-5 mt-5">
    <h1>Riwayat</h1>
    <hr>
    <div class="w-full h-max max-h-56 overflow-y-scroll flex flex-col gap-2 rounded mt-2">
        <?php $jadwalPengangkutanDatas = $jadwalPengangkutan->getByIdPetugasSelesai($_SESSION["userData"]["idUser"]);
        foreach ($jadwalPengangkutanDatas["data"] as $data) { ?>

            <div class="w-full flex flex-row justify-between p-2 border border-zinc-700 rounded">
                <div class="w-full flex flex-col">
                    <p class="text-sm"><?= $data["tglJadwalPengangkutan"] ?></p>
                    <p class="text-sm">Status: <?= $data["statusJadwalPengangkutan"] ?></p>
                    <p class="text-sm">Petugas: <?= $data["petugasUsername"] ?></p>
                    <p class="text-sm">Admin: <?= $data["adminUsername"] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php require_once("../templates/footer.php") ?>