<?php
class petugas
{
    private $conn;
    private $table = 'petugas';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $result = mysqli_query($this->conn, "SELECT `petugas`.*, `users`.*
FROM `petugas` 
	LEFT JOIN `users` ON `petugas`.`idUser` = `users`.`idUser`");
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAllNotDeleted()
    {
        $result = mysqli_query($this->conn, "SELECT `petugas`.*, `users`.*
FROM `petugas` 
	LEFT JOIN `users` ON `petugas`.`idUser` = `users`.`idUser` WHERE status != 'deleted'");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return [
                "status" => true,
                "message" => "Petugas found",
                "data" => $data
            ];
        } else {
            return [
                "status" => false,
                "message" => "Petugas not found",
            ];
        }
    }

    public function getById($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM petugas WHERE idUser = '$id'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $result = [
                "status" => true,
                "message" => "Petugas found",
                "data" => $row
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Petugas not found",
            ];
            return $result;
        }
    }
}
