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
        <div class="w-full flex flex-col">
            <div class="w-full flex flex-row justify-between items-center">
                <h1 class="text-2xl my-3">List Voucher</h1>
                <button onclick="openVouherTambah()" class="w-96 bg-zinc-700 p-2 my-2 rounded" style="color: white;">Tambah</button>
            </div>
            <div id="vouherTambah" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                <script>
                    function openVouherTambah() {
                        document.getElementById("vouherTambah").classList.remove("hidden");
                    }

                    function closeVouherTambah() {
                        document.getElementById("vouherTambah").classList.add("hidden");
                    }
                </script>
                <div class="bg-white p-5 rounded shadow-md w-2/6 h-max mx-5">
                    <form action="<?= $url ?>/Api/routes.php?action=tambahVoucher" method="post">
                        <h1 class="text-2xl text-center">Tambah Voucher</h1>
                        <div class="flex flex-col w-full mt-5 gap-2">
                            <input type="text" name="idVoucher" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="idVoucher" hidden>
                            <input type="text" name="namaVoucher" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Nama Voucher">
                            <input type="text" name="hargaVoucher" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Harga Voucher">
                            <button type="submit" name="submitTambahVoucher" value="" class="bg-[#026a75] textWhite rounded-md p-2 w-full">Tambah</button>
                        </div>
                    </form>

                    <button onclick="closeVouherTambah()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Tutup</button>
                </div>
            </div>
            <div class="w-full h-96 overflow-y-scroll flex flex-col hideScrollbar rounded-md g">
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
                    <?php $voucherData = $voucher->getAllNotDeleted();
                    foreach ($voucherData as $row) { ?>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3"> <?= $row["idVoucher"]; ?></td>
                                <td class="px-4 py-3"><?= $row["namaVoucher"]; ?></td>
                                <td class="px-4 py-3"><?= $row["hargaVoucher"]; ?></td>
                                <td class="px-4 py-3"><?= $row["statusVoucher"]; ?></td>
                                <td class="px-4 py-3 flex justify-center gap-2">
                                    <button onclick="openModalIdVoucher<?= $row['idVoucher'] ?>()" class="bg-yellow-500 w-full textWhite px-4 py-2 mt-3 rounded">Edit</button>
                                    <button onclick="deleteVoucher<?= $row['idVoucher'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Delete</button>
                                </td>
                            </tr>
                        </tbody>


                        <div id="modalIdVoucher<?= $row['idVoucher'] ?>" class="fixed inset-0 flex items-center justify-center hidden" style="background-color: rgb(36, 36, 36, 0.8)">
                            <script>
                                function openModalIdVoucher<?= $row['idVoucher'] ?>() {
                                    document.getElementById("modalIdVoucher<?= $row['idVoucher'] ?>").classList.remove("hidden");
                                }

                                function closeModalIdVoucher<?= $row['idVoucher'] ?>() {
                                    document.getElementById("modalIdVoucher<?= $row['idVoucher'] ?>").classList.add("hidden");
                                }
                            </script>
                            <div class="bg-white p-5 rounded shadow-md w-2/6 h-max mx-5">
                                <form action="<?= $url ?>/Api/routes.php?action=editVoucher" method="post">
                                    <h1 class="text-2xl text-center">Edit Voucher</h1>
                                    <div class="flex flex-col w-full mt-5 gap-2">
                                        <input type="text" name="idVoucher" value="<?= $row['idVoucher'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="idVoucher" hidden>
                                        <input type="text" name="namaVoucher" value="<?= $row['namaVoucher'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Nama Voucher">
                                        <input type="text" name="hargaVoucher" value="<?= $row['hargaVoucher'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Harga Voucher">
                                        <input type="text" name="statusVoucher" value="<?= $row['statusVoucher'] ?>" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Status Voucher">
                                        <button type="submit" name="submitEditVoucher" value="" class="bg-[#026a75] textWhite rounded-md p-2 w-full">Edit</button>
                                    </div>
                                </form>

                                <button onclick="closeModalIdVoucher<?= $row['idVoucher'] ?>()" class="bg-red-500 w-full textWhite px-4 py-2 mt-3 rounded">Tutup</button>
                            </div>
                        </div>
                        <script>
                            function openModalIdVoucher<?= $row['idVoucher'] ?>() {
                                document.getElementById("modalIdVoucher<?= $row['idVoucher'] ?>").classList.remove("hidden");
                            }

                            function closeModalIdVoucher<?= $row['idVoucher'] ?>() {
                                document.getElementById("modalIdVoucher<?= $row['idVoucher'] ?>").classList.add("hidden");
                            }

                            function deleteVoucher<?= $row['idVoucher'] ?>() {
                                Swal.fire({
                                    title: 'Apakah Anda Yakin?',
                                    text: "Anda tidak akan dapat mengembalikan data ini!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Hapus!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "<?= $url ?>/Api/routes.php?action=deleteVoucher&idVoucher=<?= $row['idVoucher'] ?>";
                                    }
                                })
                            }
                        </script>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>



<?php require_once("../templates/dashoardSidebarFooter.php"); ?>
<?php require_once("../templates/footer.php") ?>