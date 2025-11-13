<div class="w-full h-9/1 flex flex-col gap-1 rounded-md">
    <div class="flex flex-row justify-between items-center">
        <h1 class="text-xl font-semibold">Voucher</h1>
    </div>
    <div class="flex flex-col gap-2 overflow-x-scroll">
        <?php
        $voucher = $voucher->getAllActive();
        foreach ($voucher as $row) { ?>
            <div class="flex flex-row border p-2 border-zinc-700 text-sm text-white rounded textWhite">
                <div class="flex flex-col w-4/6">
                    <h1><?= $row["namaVoucher"] ?></h1>
                    <p>Point: <?= $row["hargaVoucher"] ?></p>
                </div>

                <button onclick="tukarPoint<?= $row['idVoucher'] ?>()" class="w-2/6 bg-zinc-700 textWhite px-4 py-2 rounded">Tukar</button>
                <script>
                    function tukarPoint<?= $row["idVoucher"] ?>() {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Anda akan menukarkan voucher <?= $row["namaVoucher"] ?> ?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, tukar!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "<?= $url ?>/Api/routes.php?action=tukarPoint&idVoucher=<?= $row['idVoucher'] ?>";
                            }
                        })
                    }
                </script>
            </div>
        <?php } ?>
    </div>
</div>