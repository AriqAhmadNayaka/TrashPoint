<?php
require_once("Api/config.php");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen dengan Bootstrap</title>
    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            background-color: #f4f4f4;
        }

        #loading {
            text-align: center;
        }

        #logo {
            width: 300px;
            /* Sesuaikan ukuran logo */
        }

        .progress {
            width: 200px;
            height: 20px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div id="loading" style="width: 100%; padding-right: 1rem; padding-left: 1rem;">
        <img id="logo" src="<?= $url ?>/assets/images/trashpointTextDark.png" alt="">
        <div class="progress" style="width: 100%; margin-top: 2rem;">
            <div class="progress-bar progress-bar-animated" style="width: 0%; background-color: #3f3f46;" id="progress-bar"></div>
        </div>
    </div>

    <script>
        let progress = 0;
        let progressBar = document.getElementById("progress-bar");

        function updateProgress() {
            progress += 20;
            progressBar.style.width = progress + "%";

            if (progress >= 100) {
                setTimeout(() => {
                    window.location.href = "<?= $url ?>/App/pages/login.php";
                }, 500);
            } else {
                setTimeout(updateProgress, 1000); // Update setiap 1 detik
            }
        }


        updateProgress();
    </script>

</body>

</html>