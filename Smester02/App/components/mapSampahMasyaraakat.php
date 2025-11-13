<div class="w-full h-max flex flex-col gap-1">
    <div id="map" class="w-full h-56 rounded-md border border-zinc-700"></div>
    <script>
        var map = L.map('map').setView([-6.234, 106.979], 13); // Koordinat pusat Bekasi

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            zoomControl: false,
        }).addTo(map);

        var locations = [
            <?php $dataTempatSampah = $tempatSampah->getAllBelumPenuh();
            foreach ($dataTempatSampah as $row) { ?> {
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
                        window.location.href = "<?= $url ?>/Api/routes.php?action=createHistoryBuangSampah&idMasyarakat=<?= $_SESSION['userData']['idMasyarakat'] ?>&idTempatSampah=" + location.idTempatSampah;
                    }
                });
            });

        });

        document.querySelector('.leaflet-control-zoom').remove();
        document.querySelector('.leaflet-control-attribution').remove();
    </script>
</div>