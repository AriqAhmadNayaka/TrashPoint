<?php require_once("../templates/header.php") ?>
<?php
if (isset($_GET["message"])) {
    if ($_GET["message"] == "successBuangSampah") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Buang Sampah!',
                text: 'Terimakasih sudah buang sampah!',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        </script>";
    } else if ($_GET["message"] == "berhasilTukarPoint") {
        echo "<script>
        Swal.fire({
            title: 'Berhasil Tukar Point!',
                text: 'Terimakasih sudah tukar point!',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        </script>";
    } else if ($_GET["message"] == "pointKurang") {
        echo "<script>
        Swal.fire({
            title: 'Gagal Tukar Point!',
                text: 'Point Anda tidak cukup!',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        </script>";
    }
}

$dataTempatSampah = $tempatSampah->getAllBelumPenuh();
?>

<div class="w-full h-max flex flex-col px-5 pt-5 pb-2">
    <div class="w-full h-max flex flex-row justify-between items-center">
        <h1 class="">Tpoint</h1>
        <h1 class="">Home</h1>
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
    <div class="w-full h-max flex flex-row justify-between items-center gap-2 mt-5">

    </div>
</div>
<div class="w-full h-screen flex flex-col items-center px-5 overflow-x-scroll">
    <div class="w-full h-max border border-zinc-700 rounded-md flex flex-row justify-between items-center gap-2 px-5 py-2">
        <div class="flex flex-col">
            <h1 class="text-xl font-semibold">Hi <?= $_SESSION["userData"]["username"] ?>!</h1>
            <h1 class="text-sm">Sudahkah anda buang <br>sampah hari ini?</h1>
        </div>
        <div class="">
            <img src="../../assets/images/recycling-concept-illustration.png" style="height: 100px;" alt="">
        </div>
    </div>




    <div class="flex flex-col w-full h-max gap-2 mt-5">
        <h1 class="text-xl font-semibold">Tempat sampah</h1>
        <?php require_once("../components/mapSampahMasyaraakat.php") ?>
    </div>
    <!-- <?php require_once("../components/historyBuangsampah.php") ?> -->
    <!-- <?php require_once("../components/historyPenukaran.php") ?> -->

    <div class="mt-5"></div>
</div>

<div class="fixed bottom-5 left-4 rounded-lg w-11/12 bg-zinc-700 text-white shadow-lg">
    <div class="flex items-center justify-around p-4">
        <div onclick="document.location.href='<?= $url ?>/App/pages/home.php'" class=" p-2 bg-white rounded-md flex flex-row items-center gap-3">
            <svg fill="none" height="30" viewBox="0 0 24 24" width="30" xmlns="http://www.w3.org/2000/svg" id="fi_6997164">
                <path clip-rule="evenodd" d="m20.479 7.57827-5.386-4.45325c-1.8143-1.50003-4.3717-1.50003-6.18597 0l-5.38606 4.45325c-.97038.80232-1.52097 2.01878-1.52097 3.28803v6.9446c0 2.2551 1.73415 4.1891 4 4.1891h2c1.10457 0 2-.8954 2-2v-3.2522c0-1.2675.9521-2.1891 2-2.1891s2 .9216 2 2.1891v3.2522c0 1.1046.8954 2 2 2h2c2.2659 0 4-1.934 4-4.1891v-6.9446c0-1.26924-.5506-2.48571-1.521-3.28803z" fill="#3f3f46" fill-rule="evenodd"></path>
            </svg>
        </div>
        <div onclick="document.location.href='<?= $url ?>/App/pages/voucherMasyarakat.php'" class=" p-2 bg-zinc-700 rounded-md flex flex-row items-center gap-3">
            <svg fill="#fff" fill-rule="evenodd" id="fi_9573491" height="30" viewBox="0 0 32 32" width="30" xmlns="http://www.w3.org/2000/svg">
                <path d="m29 13c.552 0 1-.448 1-1v-3c0-1.654-1.346-3-3-3h-6v3c0 .552-.448 1-1 1s-1-.448-1-1v-3h-14c-1.654 0-3 1.346-3 3v3c0 .552.448 1 1 1 1.654 0 3 1.346 3 3s-1.346 3-3 3c-.552 0-1 .448-1 1v3c0 1.654 1.346 3 3 3h14v-3c0-.552.448-1 1-1s1 .448 1 1v3h6c1.654 0 3-1.346 3-3v-3c0-.552-.448-1-1-1-1.654 0-3-1.346-3-3s1.346-3 3-3zm-8 6c0 .552-.448 1-1 1s-1-.448-1-1v-1c0-.552.448-1 1-1s1 .448 1 1zm0-5c0 .552-.448 1-1 1s-1-.448-1-1v-1c0-.552.448-1 1-1s1 .448 1 1z"></path>
            </svg>
        </div>
        <div onclick="document.location.href='<?= $url ?>/App/pages/historyMasyarakat.php'" class=" p-2 bg-zinc-700 rounded-md flex flex-row items-center gap-3">
            <svg fill="#fff" fill-rule="evenodd" width="30" height="30" version="1.1" id="fi_754201" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 409.6 409.6" style="enable-background:new 0 0 409.6 409.6;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M307.2,238.935c-47.114,0-85.335,38.2-85.335,85.33c0,47.119,38.221,85.335,85.335,85.335
            c47.114,0,85.335-38.216,85.335-85.335C392.535,277.135,354.314,238.935,307.2,238.935z M358.4,337.065h-64v-64H320v38.4h38.4
            V337.065z"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M290.135,0H51.2C32.435,0,17.065,15.365,17.065,34.135v307.2c0,18.765,15.37,34.13,34.135,34.13h136.535v-51.2
            c0-65.864,53.601-119.465,119.465-119.465h17.065V34.135C324.265,15.365,308.9,0,290.135,0z M68.265,51.2h170.67v34.135H68.265
            V51.2z M136.535,290.135h-68.27V256h68.27V290.135z M170.665,221.865h-102.4v-34.13h102.4V221.865z M273.065,153.6h-204.8v-34.135
            h204.8V153.6z"></path>
                    </g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
            </svg>
        </div>
    </div>
</div>


<?php require_once("../templates/footer.php") ?>