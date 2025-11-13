<?php
class admin
{
    private $conn;
    private $table = 'admin';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getById($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE idUser = '" . $id . "'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $data = [
                "status" => true,
                "message" => "Admin found",
                "data" => [
                    "idUser" => $row["idUser"],
                    "idAdmin" => $row["idAdmin"],
                ]
            ];
            return $data;
        } else {
            $data = [
                "status" => false,
                "message" => "Admin not found",
            ];
            return $data;
        }
    }
}
