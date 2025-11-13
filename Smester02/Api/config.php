<?php
session_start();
require_once 'models/tempatSampah.php';
require_once 'models/users.php';
require_once 'models/masyarakat.php';
require_once 'models/historyBuangSampah.php';
require_once 'models/voucher.php';
require_once 'models/penukaranVoucher.php';
require_once 'models/admin.php';
require_once 'models/jadwalPengangkutan.php';
require_once 'models/detailPengangkutan.php';
require_once 'models/petugas.php';
require_once 'database.php';

//=================================================================================================
$settings =
    [
        [
            "url" => "http://10.60.40.204/TrashPoint",
            "database" => [
                "host" => "localhost",
                "username" => "root",
                "password" => "",
                "database" => "trashpointlama"
            ]
        ],
        [
            "url" => "http://localhost/TrashPoint",
            "database" => [
                "host" => "localhost",
                "username" => "root",
                "password" => "",
                "database" => "trashpointlama"
            ]
        ],
        [
            "url" => "https://ariqnayaka.cyou",
            "database" => [
                "host" => "153.92.15.54",
                "username" => "u732553384_root",
                "password" => "=N~x2Im;",
                "database" => "u732553384_trashpoint"
            ]
        ]
    ];
//=================================================================================================

//=================================================================================================
$settings = $settings[1];
$database = new database($settings["database"]["host"], $settings["database"]["username"], $settings["database"]["password"], $settings["database"]["database"]);
$db = $database->getConnection();
$url = $settings["url"];
//=================================================================================================



$users = new users($db);
$tempatSampah = new tempatSampah($db);
$masyarakat = new masyarakat($db);
$historyBuangSampah = new historyBuangSampah($db);
$voucher = new voucher($db);
$penukaranVoucher = new penukaranVoucher($db);
$admin = new admin($db);
$jadwalPengangkutan = new jadwalPengangkutan($db);
$detailPengangkutan = new detailPengangkutan($db);
$petugas = new petugas($db);
