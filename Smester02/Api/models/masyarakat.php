<?php

use Dom\Mysql;

class masyarakat
{
    private $conn;
    private $table = 'masyarakat';

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
                "message" => "Masyarakat found",
                "data" => [
                    "idUser" => $row["idUser"],
                    "idMasyarakat" => $row["idMasyarakat"],
                    "point" => $row["point"]
                ]
            ];
            return $data;
        } else {
            $data = [
                "status" => false,
                "message" => "Masyarakat not found",
            ];
            return $data;
        }
    }

    public function create($data)
    {
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES (null,'" . $data["idUser"] . "', '0')");
        $id = mysqli_query($this->conn, "SELECT idMasyarakat FROM " . $this->table . " WHERE idUser = '" . $data["idUser"] . "'");
        $id = mysqli_fetch_assoc($id);
        if ($result) {
            $result = [
                "status" => true,
                "message" => "Masyarakat created successfully",
                "data" => [
                    "idUser" => $data["idUser"],
                    "idMasyarakat" => $id["idMasyarakat"],
                    "username" => $data["username"],
                    "email" => $data["email"],
                    "password" => $data["password"],
                    "phoneNumber" => $data["phoneNumber"],
                    "role" => $data["role"],
                    "status" => $data["status"],
                    "point" => 0
                ]
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Masyarakat creation failed",
            ];
            return $result;
        }
    }

    public function addPoint($id, $point)
    {
        $result = mysqli_query($this->conn, "UPDATE " . $this->table . " SET point = point + '" . $point . "' WHERE idMasyarakat = '" . $id . "'");
        if ($result) {
            $result = [
                "status" => true,
                "message" => "Point added successfully",
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Point addition failed",
            ];
            return $result;
        }
    }

    public function updatePoint($idMasyarakat, $point)
    {
        $result = mysqli_query($this->conn, "UPDATE " . $this->table . " SET point = '$point' WHERE idMasyarakat = '$idMasyarakat'");
        if ($result) {
            $result = [
                "status" => true,
                "message" => "success"
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "failed"
            ];
            return $result;
        }
    }
}
