<?php
class detailPengangkutan
{
    private $conn;
    private $table = 'detailpengangkutan';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getById($id)
    {
        $result = mysqli_query($this->conn, "SELECT `detailpengangkutan`.*, `tempatsampah`.`kotaTempatSampah`, `tempatsampah`.`jalanTempatSampah`, `tempatsampah`.`statusTempatSampah`
FROM `detailpengangkutan` 
	LEFT JOIN `tempatsampah` ON `detailpengangkutan`.`idTempatSampah` = `tempatsampah`.`idTempatSampah` WHERE idJadwalPengangkutan = '" . $id . "'");

        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $row[] = $rows;
            }

            $data = [
                "status" => true,
                "message" => "Detail Pengangkutan found",
                "data" => $row
            ];
            return $data;
        } else {
            $data = [
                "status" => false,
                "message" => "Detail Pengangkutan not found",
            ];
            return $data;
        }
    }

    public function getByIdJadwalPengangkutan($id)
    {
        $result = mysqli_query($this->conn, "SELECT `detailpengangkutan`.*, `tempatsampah`.*
FROM `detailpengangkutan` 
	LEFT JOIN `tempatsampah` ON `detailpengangkutan`.`idTempatSampah` = `tempatsampah`.`idTempatSampah` WHERE idJadwalPengangkutan = '" . $id . "' AND `tempatSampah`.`statusTempatSampah` = 'collecting'");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            $datas = [
                "status" => true,
                "message" => "Jadwal Pengangkutan found",
                "data" => $data
            ];
            return $datas;
        } else {
            $data = [
                "status" => false,
                "message" => "Jadwal Pengangkutan not found",
            ];
            return $data;
        }
    }

    public function create($idJadwalPengangkutan, $idTempatSampah)
    {
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES (null,'" . $idJadwalPengangkutan . "', '" . $idTempatSampah . "')");
        if ($result) {
            $data = [
                "status" => true,
                "message" => "Detail Pengangkutan created successfully",
            ];
            return $data;
        } else {
            $data = [
                "status" => false,
                "message" => "Detail Pengangkutan creation failed",
            ];
            return $data;
        }
    }
}
