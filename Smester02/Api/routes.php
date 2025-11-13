<?php
require_once 'config.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

if (!isset($_SESSION["userData"])) {
    $userData = null;
} else {
    $userData = $_SESSION["userData"];
}

if ($action == "getAllTempatSampah") {
    $data = $tempatSampah->getAll();
    echo json_encode($data);
} elseif ($action == "createUserMasyarakat") {
    $result = $users->create($_POST);
    if ($result["status"] == true) {
        $result = $masyarakat->create($result["data"]);
        header("Location: $url/App/pages/regist.php?message=successCreateUser");
        echo json_encode($result);
    } else {
        echo json_encode($result);
    }
} else if ($action == "login") {

    $result = $users->login($_POST);
    var_dump($result);
    if ($result["status"] == true) {
        if ($result["data"]["role"] == "admin") {
            $userAdmin = $admin->getById($result["data"]["idUser"]);
            if ($userAdmin["status"] == true) {
                $_SESSION["userData"] = [
                    "idUser" => $result["data"]["idUser"],
                    "idAdmin" => $userAdmin["data"]["idAdmin"],
                    "username" => $result["data"]["username"],
                    "email" => $result["data"]["email"],
                    "password" => $result["data"]["password"],
                    "phoneNumber" => $result["data"]["phoneNumber"],
                    "role" => $result["data"]["role"],
                    "status" => $result["data"]["status"],
                ];
            } else {
                $result = [
                    "status" => false,
                    "message" => "Login failed",
                    "data" => $userAdmin
                ];
            }

            header("Location: $url/App/pages/login.php?message=successLogin&role=admin");
            // echo json_encode($result);
        } else if ($result["data"]["role"] == "masyarakat") {
            $userMasyarakat = $masyarakat->getById($result["data"]["idUser"]);
            if ($userMasyarakat["status"] == true) {
                $_SESSION["userData"] = [
                    "idUser" => $result["data"]["idUser"],
                    "idMasyarakat" => $userMasyarakat["data"]["idMasyarakat"],
                    "username" => $result["data"]["username"],
                    "email" => $result["data"]["email"],
                    "password" => $result["data"]["password"],
                    "phoneNumber" => $result["data"]["phoneNumber"],
                    "role" => $result["data"]["role"],
                    "status" => $result["data"]["status"],
                    "point" => $userMasyarakat["data"]["point"],
                ];

                $result = [
                    "status" => true,
                    "message" => "Login successful",
                    "data" => $_SESSION["userData"]
                ];
                header("Location: $url/App/pages/login.php?message=successLogin&role=masyarakat");
            } else {
                $result = [
                    "status" => false,
                    "message" => "Login failed",
                ];
                // echo json_encode($result);

                header("Location: $url/App/pages/login.php?message=failedLogin");
            }
            echo json_encode($result);
        } else {
            $userPetugas = $petugas->getById($result["data"]["idUser"]);
            if ($userPetugas["status"] == true) {
                $_SESSION["userData"] = [
                    "idUser" => $result["data"]["idUser"],
                    "idPetugas" => $userPetugas["data"]["idPetugas"],
                    "username" => $result["data"]["username"],
                    "email" => $result["data"]["email"],
                    "password" => $result["data"]["password"],
                    "phoneNumber" => $result["data"]["phoneNumber"],
                    "role" => $result["data"]["role"],
                    "status" => $result["data"]["status"],
                ];
            } else {
                $result = [
                    "status" => false,
                    "message" => "Login failed",
                    "data" => $userPetugas
                ];
            }

            header("Location: $url/App/pages/login.php?message=successLogin&role=petugas");
        }
    } else {
        header("Location: $url/App/pages/login.php?message=failed");
        echo json_encode($result);
    }
} else if ($action == "logout") {
    session_destroy();
    header("Location: $url");

    echo json_encode([
        "status" => true,
        "message" => "Logout successful",
    ]);
} else if ($action == "createHistoryBuangSampah") {
    // if ($userData != null) {
    $result = $historyBuangSampah->create($_GET);
    if ($result["status"] == true) {
        $result = $masyarakat->addPoint($_GET["idMasyarakat"], 50);
        if ($result["status"] == true) {
            $_SESSION["userData"]["point"] = $userData["point"] + 50;
            header("Location: $url/App/pages/home.php?message=successBuangSampah");

            echo json_encode($result);
        } else {
            echo json_encode($result);
        }
    } else {
        echo json_encode($result);
    }
    // } else {
    //     echo json_encode([
    //         "status" => false,
    //         "message" => "User not logged in",
    //     ]);
    // }
} else if ($action == "getHistoryBuangSampah") {
    if ($userData != null) {
        $result = $historyBuangSampah->getById($userData["idMasyarakat"]);
        echo json_encode($result);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "User not logged in",
        ]);
    }
} else if ($action == "showDataUser") {
    if (isset($_SESSION["userData"])) {
        echo "Login data found in session";
        echo "\nIDUSER: " . $userData["idUser"];
        echo "\nIDMASYARAKAT: " . $userData["idMasyarakat"];
        echo "\nName: " . $userData["nama"];
        echo "\nEmail: " . $userData["email"];
        echo "\nPassword: " . $userData["password"];
        echo "\nPoint: " . $userData["point"];
        echo "\n\n\n";
    } else {
        echo "not login yet";
    }
} else if ($action == "createVoucher") {
    $result = $voucher->create($_GET);
    echo json_encode($result);
} else if ($action == "tukarPoint") {
    $result = $voucher->checkPoint($userData, $_GET["idVoucher"]);
    if ($result["status"] == true) {
        $userData["point"] = $result["data"]["point"];
        $_SESSION["userData"]["point"] = $userData["point"];
        $masyarakat->updatePoint($userData["idMasyarakat"], $userData["point"]);
        $result = $penukaranVoucher->create($userData["idMasyarakat"], $_GET["idVoucher"]);
        if ($result["status"] == true) {
            // $result = $detailPenukaranVoucher->create($result["data"]["idPenukaranVoucher"], $_GET["idVoucher"]);
            header("Location: $url/App/pages/voucherMasyarakat.php?message=berhasilTukarPoint");
            echo json_encode($result);
        } else {
            header("Location: $url/App/pages/voucherMasyarakat.php?message=gagalTukarPoint");
            echo json_encode($result);
        }
    } else {
        header("Location: $url/App/pages/voucherMasyarakat.php?message=pointKurang");
        echo json_encode($result);
    }
} else if ($action == "updateTempatSampah") {
    // echo "<script>alery('test')</script>";
    $result = $tempatSampah->update($_POST);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/tempatSampah.php?message=successUpdateTempatSampah");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/tempatSampah.php?message=failedUpdateTempatSampah");
        echo json_encode($result);
    }
} else if ($action == "deleteTempatSampah") {
    $result = $tempatSampah->delete($_GET["idTempatSampah"]);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/tempatSampah.php?message=successDeleteTempatSampah");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/tempatSampah.php?message=failedDeleteTempatSampah");
        echo json_encode($result);
    }
} else if ($action == "tambahTempatSampah") {
    $result = $tempatSampah->create($_POST);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/tempatSampah.php?message=successCreateTempatSampah");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/tempatSampah.php?message=failedCreateTempatSampah");
        echo json_encode($result);
    }
} else if ($action == "tambahVoucher") {
    $result = $voucher->create($_POST);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/voucher.php?message=successCreateVoucher");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/voucher.php?message=failedCreateVoucher");
        echo json_encode($result);
    }
} else if ($action == "editVoucher") {
    $result = $voucher->update($_POST);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/voucher.php?message=successUpdateVoucher");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/voucher.php?message=failedUpdateVoucher");
        echo json_encode($result);
    }
} else if ($action == "deleteVoucher") {
    $result = $voucher->delete($_GET["idVoucher"]);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/voucher.php?message=successDeleteVoucher");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/voucher.php?message=failedDeleteVoucher");
        echo json_encode($result);
    }
} else if ($action == "acceptJadwalPengangkutan") {
    $result = $jadwalPengangkutan->acceptJadwalPengangkutan($_GET["idJadwalPengangkutan"]);
    if ($result["status"] == true) {
        $idTempatSampah = $detailPengangkutan->getByIdJadwalPengangkutan($_GET["idJadwalPengangkutan"]);
        foreach ($idTempatSampah["data"] as $value) {
            $result = $tempatSampah->updateStatus($value["idTempatSampah"], "active");
        }
        header("Location: $url/App/pages/jadwalPengangkutan.php?message=successAcceptJadwalPengangkutan");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/jadwalPengangkutan.php?message=failedAcceptJadwalPengangkutan");
        echo json_encode($result);
    }
} else if ($action == "rejectJadwalPengangkutan") {
    $result = $jadwalPengangkutan->rejectJadwalPengangkutan($_GET["idJadwalPengangkutan"]);
    if ($result["status"] == true) {
        $idTempatSampah = $detailPengangkutan->getByIdJadwalPengangkutan($_GET["idJadwalPengangkutan"]);
        foreach ($idTempatSampah["data"] as $value) {
            $result = $tempatSampah->updateStatus($value["idTempatSampah"], "penuh");
        }
        header("Location: $url/App/pages/jadwalPengangkutan.php?message=successRejectJadwalPengangkutan");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/jadwalPengangkutan.php?message=failedRejectJadwalPengangkutan");
        echo json_encode($result);
    }
} else if ($action == "createJadwalPengangkutan") {
    $result = $jadwalPengangkutan->create($_POST, $_SESSION["userData"]["idAdmin"]);
    if ($result["status"] == true) {
        foreach ($_POST["idTempatSampah"] as $value) {
            $tempatSampah->updateStatus($value, "collecting");
            $hasil = $detailPengangkutan->create($result["data"]["idJadwalPengangkutan"], $value);
        }
        header("Location: $url/App/pages/jadwalPengangkutan.php?message=successCreateJadwalPengangkutan");
        echo json_encode($hasil);
    } else {
        header("Location: $url/App/pages/jadwalPengangkutan.php?message=failedCreateJadwalPengangkutan");
        echo json_encode($hasil);
    }
} else if ($action == "setStatusJadwalPengangkutan") {
    $result = $jadwalPengangkutan->setStatusJadwalPengangkutan($_GET["idJadwalPengangkutan"], $_GET["status"]);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/homePetugas.php?message=successSetStatusJadwalPengangkutan");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/homePetugas.php?message=failedSetStatusJadwalPengangkutan");
        echo json_encode($result);
    }
} else if ($action == "ambilSampah") {
    $result = $tempatSampah->updateStatus($_GET["idTempatSampah"], $_GET["statusTempatSampah"]);
    if ($result["status"] == true) {
        header("Location: $url/App/pages/homePetugas.php?message=successUpdateStatusTempatSampah");
        echo json_encode($result);
    } else {
        header("Location: $url/App/pages/homePetugas.php?message=failedUpdateStatusTempatSampah");
        echo json_encode($result);
    }
}
