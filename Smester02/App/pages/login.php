<?php require_once("../templates/header.php") ?>

<?php
// require_once("../../Api/config.php");


if (isset($_GET['message'])) {

    if ($_GET["message"] == "successLogin") {
        $username = $_SESSION["userData"]["username"];
        if ($_SESSION["userData"]["role"] == "admin") {

            echo "<script>
        Swal.fire({
            title: 'Welcome $username!',
                text: 'Berhasil login!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$url/App/pages/jadwalPengangkutan.php';
                }
            });

        </script>";
        } else if ($_SESSION["userData"]["role"] == "masyarakat") {
            echo "<script>
            Swal.fire({
                title: 'Welcome $username!',
                text: 'Berhasil login!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$url/App/pages/home.php';
                }
            });
            
            </script>";
        } else if ($_SESSION["userData"]["role"] == "petugas") {
            echo "<script>
            Swal.fire({
                title: 'Welcome $username!',
                text: 'Berhasil login!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$url/App/pages/homePetugas.php';
                }
            });
            
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Gagal login!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Gagal login!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

?>


<div class="w-full flex flex-col justify-between items-center" style="background-color: #3f3f46; height: 25%;">
    <img src="<?= $url ?>/assets/images/trashpointTextWhite.png" height="350px" width="350px" class="mt-20" alt="">
</div>
<div class="w-full flex flex-col items-center" style="height: 75%;">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-full" viewBox="0 0 1440 320">
        <path fill="#3f3f46" fill-opacity="1" d="M0,128L30,117.3C60,107,120,85,180,112C240,139,300,213,360,224C420,235,480,181,540,181.3C600,181,660,235,720,224C780,213,840,139,900,117.3C960,96,1020,128,1080,154.7C1140,181,1200,203,1260,202.7C1320,203,1380,181,1410,170.7L1440,160L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z"></path>
    </svg>
    <div class="w-full flex flex-col items-center justify-between" style="height: 80%;">
        <div class="px-14 w-full h-full flex flex-col">
            <h1 class="text-3xl text-center mt-5">Selamat datang!</h1>
            <form action="<?= $url ?>/Api/routes.php?action=login" method="post" class="w-full mt-5">
                <div class="flex flex-col w-full mt-5 gap-2">
                    <input type="text" name="username" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Username">
                    <input type="password" name="password" class="border border-gray-300 rounded-md p-2 w-full outline-none" placeholder="Password">
                    <button type="submit" name="submit" value="submit" class="bg-zinc-700 textWhite rounded-md p-2 w-full">Login</button>
                </div>
            </form>
        </div>
    </div>
    <p class="mb-1">Belum punya akun? <a href="./regist.php" style="color: #3b82f6;">Registrasi !</a></p>
</div>

<script>
    function showAlert() {
        Swal.fire({
            title: 'Halo!',
            text: 'Ini adalah alert dari SweetAlert2!',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
</script>

<?php require_once("../templates/footer.php") ?>