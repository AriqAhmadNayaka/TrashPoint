<div class="w-full h-max flex flex-col gap-1 mt-5 rounded-md">
    <div class="bg-white flex flex-col gap-2 rounded w-full h-max">

        <?php $historyBuangSampah = $historyBuangSampah->getById($_SESSION["userData"]["idMasyarakat"]);
        if ($historyBuangSampah["status"] == false) {
            echo "<h1 class='text-lg text-center'>Belum ada history buang sampah</h1>";
        } else {
        ?><h2 class="text-xl">History Buang Sampah</h2>
            <hr>
            <div class="flex flex-col gap-2 h-max max-h-56 overflow-y-scroll">
                <?php
                foreach ($historyBuangSampah["data"] as $row) { ?>
                    <div class="flex flex-row border p-2 border-zinc-700 text-sm text-white rounded textWhite">
                        <div class="flex flex-col w-full">
                            <h1><?= $row["kotaTempatSampah"] ?></h1>
                            <div class="flex flex-row justify-between items-center w-full">
                                <p><?= $row["jalanTempatSampah"] ?></p>
                                <p><?= $row["tglBuangSampah"] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <hr>
        <?php
        } ?>
    </div>
</div>