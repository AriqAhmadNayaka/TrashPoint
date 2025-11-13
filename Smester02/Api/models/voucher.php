<?php
class voucher
{
    private $conn;
    private $table = 'voucher';

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

    public function getAllNotDeleted()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE statusVoucher != 'deleted'");
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAllActive()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE statusVoucher = 'active'");
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function create($data)
    {
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES (null,'" . $data["namaVoucher"] . "','" . $data["hargaVoucher"] . "' , 'active')");

        if ($result) {
            $result = [
                "status" => true,
                "message" => "Voucher created successfully",
                "data" => [
                    "namaVoucher" => $data["namaVoucher"],
                    "hargaVoucher" => $data["hargaVoucher"]
                ]
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Voucher creation failed",
            ];
            return $result;
        }
    }

    public function update($data)
    {
        $result = mysqli_query($this->conn, "UPDATE " . $this->table . " SET namaVoucher = '" . $data["namaVoucher"] . "', hargaVoucher = '" . $data["hargaVoucher"] . "' , statusVoucher = '" . $data["statusVoucher"] . "' WHERE idVoucher = '" . $data["idVoucher"] . "'");
        if ($result) {
            $result = [
                "status" => true,
                "message" => "Voucher updated successfully",
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Voucher update failed",
            ];
            return $result;
        }
    }

    public function delete($id)
    {
        $result = mysqli_query($this->conn, "UPDATE " . $this->table . " SET statusVoucher = 'deleted' WHERE idVoucher = '" . $id . "'");
        if ($result) {
            $result = [
                "status" => true,
                "message" => "Voucher deleted successfully",
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Voucher deletion failed",
            ];
            return $result;
        }
    }

    public function checkPoint($data, $idVoucher)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE idVoucher = '$idVoucher'");
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_assoc($result);
            if ($result["hargaVoucher"] <= $data["point"]) {
                $result = [
                    "status" => true,
                    "message" => "Success",
                    "data" => [
                        "point" => $data["point"] - $result["hargaVoucher"],
                    ]
                ];
                return $result;
            } else {
                $result = [
                    "status" => false,
                    "message" => "Need more points",
                ];
                return $result;
            }
        } else {
            $result = [
                "status" => false,
                "message" => "Wrong id",
            ];
            return $result;
        }
    }
}
