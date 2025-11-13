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

<div class="w-full flex flex-row justify-between gap-2 mt-5">
    <div class="w-full flex flex-col">
        <div class="w-full flex flex-col">
            <div class="w-full flex flex-row justify-between items-center">
                <h1 class="text-2xl my-3">Jadwal Pengangkutan Sampah</h1>
                <button onclick="openJadwalTambah()" class="w-96 bg-zinc-700 p-2 my-2 rounded" style="color: white;">Tambah</button>
            </div>
            <div id="jadwalTambah" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                <script>
                    function openJadwalTambah() {
                        document.getElementById("jadwalTambah").classList.remove("hidden");
                    }

                    function closeJadwalTambah() {
                        document.getElementById("jadwalTambah").classList.add("hidden");
                    }
                </script>
                <div class="bg-white p-5 rounded shadow-md w-2/6 h-max mx-5">
                    <form action="<?= $url ?>/Api/routes.php?action=createJadwalPengangkutan" method="post">
                        <h1 class="text-2xl text-center">Buat Jadwal</h1>
                        <div class="flex flex-col w-full mt-5 gap-2">
                            <div class="flex flex-row w-full gap-2 items-center">
                                <label for="">Pilih petugas : </label>
                                <select name="idPetugas" id="" class="border border-gray-300 rounded-md p-2 outline-none">
                                    <?php
                                    $petugasData = $petugas->getAllNotDeleted();
                                    if ($petugasData["status"] == false) {
                                        echo "<option value=''>Tidak ada petugas</option>";
                                    } else {

                                        foreach ($petugasData["data"] as $row) { ?>
                                            <option value="<?= $row['idPetugas'] ?>"><?= $row['username'] ?></option>

                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <p>Pilih Tempat sampah</p>
                            <div class="flex border rounded border-zinc-700 flex-col w-full gap-2 overflow-y-scroll hideScrollbar h-36 ">
                                <?php $tempatSampahData = $tempatSampah->getTempatSampahUntukDiAngkut();
                                if ($tempatSampahData["status"] == false) {
                                    echo "<p class='text-center text-lg font-bold'>Tidak ada tempat sampah penuh</p>";
                                } else {
                                    foreach ($tempatSampahData["data"] as $row) { ?>
                                        <div class="flex flex-row items-center">
                                            <input type="checkbox" id="<?= $row['idTempatSampah'] ?>" name="idTempatSampah[]" value="<?= $row['idTempatSampah'] ?>" class="border border-gray-300 rounded-md p-2 mx-5 outline-none" placeholder="Id Petugas">
                                            <label for="<?= $row['idTempatSampah'] ?>"><?= $row['kotaTempatSampah'] . " " . $row["jalanTempatSampah"] ?></label>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <button type="submit" name="submitTambahVoucher" value="" class="bg-[#026a75] textWhite rounded-md p-2 w-full">Tambah</button>
                        </div>
                    </form>

                    <button onclick="closeJadwalTambah()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Tutup</button>
                </div>
            </div>
            <div class="w-full h-96 overflow-y-scroll flex flex-col hideScrollbar rounded-md gap-2 py-5">
                <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                    <thead class="bg-zinc-700 text-white uppercase text-xs">
                        <tr>
                            <td class="px-4 py-3 textWhite">ID</td>
                            <td class="px-4 py-3 textWhite">PETUGAS</td>
                            <td class="px-4 py-3 textWhite">PEMBERI TUGAS</td>
                            <td class="px-4 py-3 textWhite">JADWAL</td>
                            <td class="px-4 py-3 textWhite">STATUS</td>
                            <td class="px-4 py-3 textWhite text-center">ACTION</td>
                        </tr>
                    </thead>
                    <?php
                    $jadwalPengangkutan = $jadwalPengangkutan->getAllAssigned();
                    if ($jadwalPengangkutan["status"] == false) {
                        echo "<p class='text-center text-lg font-bold'>Tidak ada jadwal</p>";
                    } else {
                        foreach ($jadwalPengangkutan["data"] as $row) { ?>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3"><?= $row["idJadwalPengangkutan"] ?></td>
                                    <td class="px-4 py-3"><?= $row["usernamePetugas"]; ?></td>
                                    <td class="px-4 py-3"><?= $row["usernameAdmin"] ?></td>
                                    <td class="px-4 py-3"><?= $row["tglJadwalPengangkutan"] ?></td>
                                    <td class="px-4 py-3"><?= $row["statusJadwalPengangkutan"] ?></td>
                                    <td class="px-4 py-3 flex justify-center gap-2">
                                        <button onclick="openModalIdJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>()" class="bg-yellow-500 w-full textWhite px-4 py-2 mt-3 rounded">Detail</button>
                                        <?php if ($row["statusJadwalPengangkutan"] == "need accept") { ?>
                                            <button onclick="acceptJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>()" class="bg-green-500 w-full textWhite px-4 py-2 mt-3 rounded">Accept</button>
                                            <button onclick="rejectJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Reject</button>
                                        <?php } else { ?>
                                            <!-- <button onclick="deleteJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Delete</button> -->
                                        <?php } ?>
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
                            <div id="modalIdJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                                <script>

                                </script>
                                <div class="bg-white p-5 rounded shadow-md w-2/6 h-max mx-5">
                                    <h1 class="text-2xl text-center">Detail Jadwal Pengangkutan</h1>
                                    <div class="flex flex-col w-full mt-5 gap-2">
                                        <?php $detailPengangkutanData = $detailPengangkutan->getById($row["idJadwalPengangkutan"]);
                                        foreach ($detailPengangkutanData["data"] as $rowDetail) { ?>
                                            <div class="flex flex-col w-full gap-2m rounded border border-zinc-700 p-2">
                                                <p class="text-lg font-bold">Id : <?= $rowDetail["idDetailPengangkutan"]; ?></p>
                                                <p class="text-lg font-bold">Alamat : <?= $rowDetail["kotaTempatSampah"] . " " .
                                                                                            $rowDetail["jalanTempatSampah"]; ?></p>
                                                <p class="text-lg font-bold">Status : <?= $rowDetail["statusTempatSampah"]; ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <button onclick="closeModalIdJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Tutup</button>
                                </div>
                            </div>
                            <script>
                                function acceptJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>() {
                                    Swal.fire({
                                        title: 'Apakah Anda Yakin?',
                                        text: "Anda tidak akan dapat mengembalikan data ini!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, Terima!'
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location.href = "<?= $url ?>/Api/routes.php?action=acceptJadwalPengangkutan&idJadwalPengangkutan=<?= $row['idJadwalPengangkutan'] ?>";
                                        }
                                    })
                                }

                                function rejectJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>() {
                                    Swal.fire({
                                        title: 'Apakah Anda Yakin?',
                                        text: "Anda tidak akan dapat mengembalikan data ini!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, Tolak!'
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location.href = "<?= $url ?>/Api/routes.php?action=rejectJadwalPengangkutan&idJadwalPengangkutan=<?= $row['idJadwalPengangkutan'] ?>";
                                        }
                                    })
                                }

                                function openModalIdJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>() {
                                    document.getElementById("modalIdJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>").classList.remove("hidden");
                                }

                                function closeModalIdJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>() {
                                    document.getElementById("modalIdJadwalPengangkutan<?= $row['idJadwalPengangkutan'] ?>").classList.add("hidden");
                                }
                            </script>
                    <?php }
                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>

<?php require_once("../templates/dashoardSidebarFooter.php"); ?>
<?php require_once("../templates/footer.php") ?>