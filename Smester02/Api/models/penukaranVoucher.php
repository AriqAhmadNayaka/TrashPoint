<?php
class penukaranVoucher
{
    private $conn;
    private $table = 'historyVoucher';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getById($id)
    {
        $result = mysqli_query($this->conn, "SELECT `historyvoucher`.`idHistoryVoucher`, `historyvoucher`.`tglPenukaran`, `voucher`.`namaVoucher`, `masyarakat`.`idMasyarakat`, `users`.`username`, `voucher`.`hargaVoucher`
FROM `historyvoucher` 
	LEFT JOIN `voucher` ON `historyvoucher`.`idVoucher` = `voucher`.`idVoucher` 
	LEFT JOIN `masyarakat` ON `historyvoucher`.`idMasyarakat` = `masyarakat`.`idMasyarakat` 
	LEFT JOIN `users` ON `masyarakat`.`idUser` = `users`.`idUser` WHERE `historyvoucher`.`idMasyarakat` = '" . $id . "'");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            $result = [
                "status" => true,
                "message" => "History found",
                "data" => $data
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "History not found",
            ];
            return $result;
        }
    }

    public function create($idMasyarakat, $idVoucher)
    {
        $date = date("Y-m-d H:i:s");
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES(null,'$idMasyarakat', '$idVoucher', '$date')");
        if ($result) {
            // $id = mysqli_query($this->conn, "SELECT idHistoryVoucher FROM " . $this->table . " WHERE tglHistoryVoucher = '$date'");
            // $id = mysqli_fetch_assoc($id);
            $result = [
                "status" => true,
                "message" => "Penukaran voucher created successfully",
                "data" => [
                    // "idHistoryVoucher" => $id["idHistoryVoucher"]
                ]
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Penukaran voucher creation failed",
            ];
            return $result;
        }
    }
}
