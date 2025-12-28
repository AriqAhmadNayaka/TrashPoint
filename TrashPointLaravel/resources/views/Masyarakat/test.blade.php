<head>
    <!-- ... meta tags ... -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<div class="w-full h-max flex flex-col gap-1 bg-gray-100">
    <div class="w-full h-screen px-56 flex flex-col gap-6 py-10 overflow-y-scroll">
        <div class="w-full h-full flex flex-row justify-between gap-5">
            <div class="w-full h-full p-3 shadow-xl rounded-xl bg-white">
                <div id="map" class="w-full h-full rounded-md border border-none"></div>
            </div>
            <div class="w-full h-full bg-white rounded-xl shadow-xl p-3">
                <div class="w-full h-1/2 overflow-y-scroll">
                    <p class="text-xl text-black">History Buang Sampah</p>
                    @php
                    use App\Models\HistoryTakeOutTrash;
                    use App\Models\Masyarakat;
                    $idMasyarakat = Masyarakat::where('idUser', Auth::user()->idUser)->first()->idMasyarakat;
                    $HistoryTakeOutTrash = HistoryTakeOutTrash::where('idMasyarakat', $idMasyarakat)->get();
                    foreach ($HistoryTakeOutTrash as $history) {
                        echo "<div class='border-b border-gray-300 py-2'>
                                <p class='text-md text-gray-700'>Tanggal: " . $history->created_at . "</p>
                                <p class='text-md text-gray-700'>Berat Sampah: " . rand(1, 10) . " kg</p>
                              </div>";
                    }
                    @endphp
                </div>
                <hr class="my-3">
                <div class="w-full h-1/2 overflow-y-scroll">
                    <p class="text-xl text-black">History Tukar Voucher</p>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between gap-5">
            <div class="w-full h-96 p-3 shadow-xl rounded-xl bg-white">
                <p class="text-xl text-black">Chat BOT</p>
            </div>
            <div class="w-full h-96 bg-white rounded-xl shadow-xl p-3">
                <p class="text-xl text-black">Tukar Voucher</p>
                @php
                use App\Models\Voucher;
                $vouchers = Voucher::all();
                foreach ($vouchers as $voucher) {
                    echo "<div class='border-b border-gray-300 py-2'>
                            <p class='text-md text-gray-700'>Kode Voucher: " . $voucher->idVoucher . "</p>
                            <p class='text-md text-gray-700'>Poin yang Dibutuhkan: " . $voucher->price . "</p>
                            <div class='flex justify-end'>
                                <button class='bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600'>Tukar</button>
                            </div>
                          </div>";
                }
                @endphp
            </div>
        </div>
    </div>
    @php
    use App\Models\Trash;
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
</div>