<?php
date_default_timezone_set('Asia/Jakarta');
class historyBuangSampah
{
    private $conn;
    private $table = 'historyBuangSampah';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getById($id)
    {
        $result = mysqli_query($this->conn, "SELECT `historybuangsampah`.`idHistoryBuangSampah`, `historybuangsampah`.`tglBuangSampah`, `historybuangsampah`.`idMasyarakat`, `masyarakat`.`idUser`, `users`.`username`, `historybuangsampah`.`idTempatSampah`, `tempatsampah`.`kotaTempatSampah`, `tempatsampah`.`jalanTempatSampah`
FROM `historybuangsampah` 
	LEFT JOIN `masyarakat` ON `historybuangsampah`.`idMasyarakat` = `masyarakat`.`idMasyarakat` 
	LEFT JOIN `users` ON `masyarakat`.`idUser` = `users`.`idUser` 
	LEFT JOIN `tempatsampah` ON `historybuangsampah`.`idTempatSampah` = `tempatsampah`.`idTempatSampah` WHERE `masyarakat`.`idMasyarakat` = '" . $id . "'");
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

    public function create($data)
    {
        $date = date("Y-m-d H:i:s");
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES (null,'" . $data["idMasyarakat"] . "', '" . $data["idTempatSampah"] . "', '$date')");
        if ($result) {
            $result = [
                "status" => true,
                "message" => "History created successfully",
                "data" => [
                    "idMasyarakat" => $data["idMasyarakat"],
                    "idTempatSampah" => $data["idTempatSampah"],
                    "tanggalBuangSampah" => $date
                ]
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "History creation failed",
            ];
            return $result;
        }
    }
}
