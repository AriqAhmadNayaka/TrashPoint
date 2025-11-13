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

<div class="w-full h-max flex flex-col">
    <div class="w-full h-max flex flex-col justify-center items-center bg-zinc-700  px-5 py-10">
        <img src="../../assets/images/jim.jpeg" class="rounded-full w-36 h-36">
        <h1 class="textWhite text-xl font-semibold mt-5"><?= $_SESSION["userData"]["username"] ?></h1>
        <h1 class="textWhite text-sm mt-1"><?= $_SESSION["userData"]["email"] ?></h1>
    </div>
</div>
<div class="w-full h-max px-5 flex flex-col">

</div>


<?php require_once("../templates/footer.php") ?>