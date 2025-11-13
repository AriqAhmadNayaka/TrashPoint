<div class='w-full h-max max-h-56 flex flex-col gap-1 mt-5'>
    <?php $historyVoucher = $penukaranVoucher->getById($_SESSION["userData"]["idMasyarakat"]);
    if ($historyVoucher["status"] == false) {
        echo "
                <h1 class='text-lg text-center'>Belum ada history penukaran voucher</h1>
              ";
    } else { ?>
        <h1 class='text-lg'>History Penukaran Voucher</h1>
        <hr>
        <div class="flex flex-col gap-2 h-56 overflow-y-scroll">
            <?php foreach ($historyVoucher["data"] as $row) { ?>
                <div class="flex flex-row border p-2 border-zinc-700 text-sm text-white rounded textWhite">
                    <div class="flex flex-col w-full">
                        <h1><?= $row["namaVoucher"] ?></h1>
                        <div class="flex flex-row justify-between items-center w-full">
                            <p>Point: <?= $row["hargaVoucher"] ?></p>
                            <p><?= $row["tglPenukaran"] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <hr>
    <?php } ?>
</div>