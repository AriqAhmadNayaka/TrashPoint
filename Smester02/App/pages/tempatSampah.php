<?php require_once("../templates/header.php"); ?>
<?php require_once("../templates/dashoardSidebarHeader.php"); ?>
<?php
if (isset($_GET["message"])) {
    if ($_GET["message"] == "successUpdateTempatSampah") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Edit Tempat Sampah',
            text: 'Berhasil Edit Tempat Sampah',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedUpdateTempatSampah") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Edit Tempat Sampah',
            text: 'Gagal Edit Tempat Sampah',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successCreateTempatSampah") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Tambah Tempat Sampah',
            text: 'Berhasil Tambah Tempat Sampah',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedCreateTempatSampah") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Tambah Tempat Sampah',
            text: 'Gagal Tambah Tempat Sampah',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successDeleteTempatSampah") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Hapus Tempat Sampah',
            text: 'Berhasil Hapus Tempat Sampah',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedDeleteTempatSampah") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Hapus Tempat Sampah',
            text: 'Gagal Hapus Tempat Sampah',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successCreateVoucher") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Tambah Voucher',
            text: 'Berhasil Tambah Voucher',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedCreateVoucher") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Tambah Voucher',
            text: 'Gagal Tambah Voucher',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successUpdateVoucher") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Edit Voucher',
            text: 'Berhasil Edit Voucher',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedUpdateVoucher") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Edit Voucher',
            text: 'Gagal Edit Voucher',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successDeleteVoucher") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Hapus Voucher',
            text: 'Berhasil Hapus Voucher',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedDeleteVoucher") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Hapus Voucher',
            text: 'Gagal Hapus Voucher',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successAcceptJadwalPengangkutan") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Terima Jadwal Pengangkutan',
            text: 'Berhasil Terima Jadwal Pengangkutan',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedAcceptJadwalPengangkutan") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Terima Jadwal Pengangkutan',
            text: 'Gagal Terima Jadwal Pengangkutan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successRejectJadwalPengangkutan") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Tolak Jadwal Pengangkutan',
            text: 'Berhasil Tolak Jadwal Pengangkutan',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedRejectJadwalPengangkutan") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Tolak Jadwal Pengangkutan',
            text: 'Gagal Tolak Jadwal Pengangkutan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "successCreateJadwalPengangkutan") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Tambah Jadwal Pengangkutan',
            text: 'Berhasil Tambah Jadwal Pengangkutan',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        </script>";
    } else if ($_GET["message"] == "failedCreateJadwalPengangkutan") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Tambah Jadwal Pengangkutan',
            text: 'Gagal Tambah Jadwal Pengangkutan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}

?>

<div class="w-full flex flex-row justify-between gap-2">
    <div class="w-full flex flex-col">
        <div class="w-full flex flex-row justify-between items-center">
            <h1 class="text-2xl">List Tempat Sampah</h1>
            <!-- <button onclick="openModalTempatSampahTambah()" class="w-96 bg-blue-400 p-2 my-2 rounded" style="color: white;">Tambah</button> -->
        </div>
        <div class="w-full h-96 overflow-y-scroll flex flex-col hideScrollbar gap-2 py-5">
            <div id="" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                <script>
                    function openModalTempatSampahTambah() {
                        document.getElementById("modalTempatSampahTambah").classList.remove("hidden");
                    }

                    function closeModalTempatSampahTambah() {
                        document.getElementById("modalTempatSampahTambah").classList.add("hidden");
                    }
                </script>
                <div class="bg-white p-5 rounded shadow-md w-2/6 h-max mx-5">

                </div>
            </div>
            <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                <thead class="bg-zinc-700 text-white uppercase text-xs">
                    <tr>
                        <td class="px-4 py-3 textWhite">ID</td>
                        <td class="px-4 py-3 textWhite">KOTA</td>
                        <td class="px-4 py-3 textWhite">JALAN</td>
                        <td class="px-4 py-3 textWhite">STATUS</td>
                        <td class="px-4 py-3 textWhite text-center">ACTION</td>
                    </tr>
                </thead>
                <?php $tempatSampahData = $tempatSampah->getAllNotDeleteds();
                foreach ($tempatSampahData as $row) { ?>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3"><?= $row["idTempatSampah"] ?></td>
                            <td class="px-4 py-3"><?= $row["kotaTempatSampah"] ?></td>
                            <td class="px-4 py-3"><?= $row["jalanTempatSampah"] ?></td>
                            <td class="px-4 py-3"><?= $row["statusTempatSampah"] ?></td>
                            <td class="px-4 py-3 flex justify-center gap-2">
                                <button onclick="openModalIdTempatSampah<?= $row['idTempatSampah'] ?>()" class="bg-yellow-500 w-full textWhite px-4 py-2 mt-3 rounded">Edit</button>
                                <button onclick="deleteTempatSampah<?= $row['idTempatSampah'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <script>
                        function deleteTempatSampah<?= $row['idTempatSampah'] ?>() {
                            Swal.fire({
                                title: 'Apakah Anda Yakin?',
                                text: "Anda tidak akan dapat mengembalikan data ini!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= $url ?>/Api/routes.php?action=deleteTempatSampah&idTempatSampah=<?= $row['idTempatSampah'] ?>";
                                }
                            })
                        }
                    </script>
                    <div id="modalIdTempatSampah<?= $row['idTempatSampah'] ?>" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                        <div class="bg-white p-5 mb-96 rounded shadow-md w-2/6 h-max mx-5">
                            <form action="<?= $url ?>/Api/routes.php?action=updateTempatSampah" method="post">
                                <h1 class="text-2xl text-center">Edit Tempat Sampah</h1>
                                <div class="flex flex-col w-full mt-5 gap-2">

                                    <input type="text" name="idTempatSampah" value="<?= $row['idTempatSampah'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Id Tempat Sampah" hidden>
                                    <input type="text" name="kotaTempatSampah" value="<?= $row['kotaTempatSampah'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Kota Tempat Sampah">
                                    <input type="text" name="jalanTempatSampah" value="<?= $row['jalanTempatSampah'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Jalan Tempat Sampah">
                                    <!-- <input type="text" name="statusTempatSampah" value="<?= $row['statusTempatSampah'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Status Tempat Sampah"> -->
                                    <select class="border border-gray-300 rounded-md p-2 w-full outline-none" name="statusTempatSampah">
                                        <option value="active" selected>Select status</option>
                                        <option value="active">Active</option>
                                        <option value="penuh">Penuh</option>
                                    </select>
                                    <button type="submit" name="submitEditTempatsampah<?= $row['idTempatSampah'] ?>" value="<?= $row['idTempatSampah'] ?>" class="bg-[#026a75] textWhite rounded-md p-2 w-full">Edit</button>
                                </div>
                            </form>

                            <button onclick="closeModalIdTempatSampah<?= $row['idTempatSampah'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Tutup</button>
                        </div>
                    </div>
                    <script>
                        function openModalIdTempatSampah<?= $row['idTempatSampah'] ?>() {
                            document.getElementById("modalIdTempatSampah<?= $row['idTempatSampah'] ?>").classList.remove("hidden");
                        }

                        function closeModalIdTempatSampah<?= $row['idTempatSampah'] ?>() {
                            document.getElementById("modalIdTempatSampah<?= $row['idTempatSampah'] ?>").classList.add("hidden");
                        }
                    </script>
                <?php } ?>
            </table>
        </div>
    </div>

</div>
<div class="flex flex-col w-full mt-10">
    <h1 class="text-2xl">Tambah Tempat Sampah</h1>
    <form class="flex flex-row gap-2" action="<?= $url ?>/Api/routes.php?action=tambahTempatSampah" method="post">
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
        <div class="flex flex-col w-full mt-5 gap-2">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="text" name="idTempatSampah" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Id Tempat Sampah" hidden>
            <input type="text" name="kotaTempatSampah" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Kota Tempat Sampah">
            <input type="text" name="jalanTempatSampah" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Jalan Tempat Sampah">
            <input type="text" hidden value="active" name="statusTempatSampah" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Status Tempat Sampah">
            <button type="submit" name="submitEditTempatsampah" value="" class="bg-zinc-700 textWhite rounded-md p-2 w-full">Tambah</button>
        </div>
    </form>
</div>

<?php require_once("../templates/dashoardSidebarFooter.php"); ?>
<?php require_once("../templates/footer.php") ?>