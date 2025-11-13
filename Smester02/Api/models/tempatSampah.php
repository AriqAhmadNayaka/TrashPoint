<?php
class tempatSampah
{
    private $conn;
    private $table = 'tempatsampah';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getAllBelumPenuh()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE statusTempatSampah != 'penuh'");
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
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
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE statusTempatSampah != 'deleted'");
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTempatSampahUntukDiAngkut()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE statusTempatSampah = 'penuh'");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return [
                "status" => true,
                "message" => "Tempat Sampah Penuh",
                "data" => $data
            ];
        } else {
            return [
                "status" => false,
                "message" => "Tidak ada tempat sampah penuh"
            ];
        }
    }

    public function create($data)
    {
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES (null,'" . $data[""] . "', '" . $data[""] . "', '" . $data[""] . "', '" . $data["latitude"] . "', '" . $data["longitude"] . "')");
        if ($result) {
            return [
                "status" => true,
                "message" => "Data created successfully"
            ];
        } else {
            return [
                "status" => false,
                "message" => "Failed to create data"
            ];
        }
    }

    public function updateStatus($id, $status)
    {
        mysqli_query($this->conn, "UPDATE " . $this->table . " SET statusTempatSampah = '" . $status . "' WHERE idTempatSampah = '" . $id . "'");
        if (mysqli_affected_rows($this->conn) > 0) {
            return [
                "status" => true,
                "message" => "Status updated successfully"
            ];
        } else {
            return [
                "status" => false,
                "message" => "Failed to update status"
            ];
        }
    }

    public function update($data)
    {
        mysqli_query($this->conn, "UPDATE " . $this->table . " SET kotaTempatSampah = '" . $data['kotaTempatSampah'] . "', jalanTempatSampah = '" . $data['jalanTempatSampah'] . "', statusTempatSampah = '" . $data['statusTempatSampah'] . "' WHERE idTempatSampah = '" . $data['idTempatSampah'] . "'");
        if (mysqli_affected_rows($this->conn) > 0) {
            return [
                "status" => true,
                "message" => "Data updated successfully"
            ];
        } else {
            return [
                "status" => false,
                "message" => "Failed to update data"
            ];
        }
    }

    public function delete($id)
    {
        mysqli_query($this->conn, "UPDATE " . $this->table . " SET statusTempatSampah = 'deleted' WHERE idTempatSampah = '" . $id . "'");
        if (mysqli_affected_rows($this->conn) > 0) {
            return [
                "status" => true,
                "message" => "Data deleted successfully"
            ];
        } else {
            return [
                "status" => false,
                "message" => "Failed to delete data"
            ];
        }
    }
}
