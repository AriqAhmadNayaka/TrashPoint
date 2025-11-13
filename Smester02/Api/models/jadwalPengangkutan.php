<?php
class jadwalPengangkutan
{
    private $conn;
    private $table = 'jadwalpengangkutan';

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

    public function getAllAssigned()
    {
        $result = mysqli_query($this->conn, "SELECT 
    jp.*, 
    a.idUser AS idAdmin, 
    u1.username AS usernameAdmin,
    p.idUser AS idPetugas, 
    u2.username AS usernamePetugas
FROM jadwalpengangkutan jp
LEFT JOIN admin a ON jp.idAdmin = a.idAdmin
LEFT JOIN users u1 ON a.idUser = u1.idUser
LEFT JOIN petugas p ON jp.idPetugas = p.idPetugas
LEFT JOIN users u2 ON p.idUser = u2.idUser WHERE statusJadwalPengangkutan = 'assigned' OR statusJadwalPengangkutan = 'on progress' OR statusJadwalPengangkutan = 'need accept'");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return [
                "status" => true,
                "message" => "Jadwal Pengangkutan found",
                "data" => $data
            ];
        } else {
            $data = [
                "status" => false,
                "message" => "Jadwal Pengangkutan not found",
            ];
            return $data;
        }
    }

    public function getAllDone()
    {
        $result = mysqli_query($this->conn, "SELECT 
    jp.*, 
    a.idUser AS idAdmin, 
    u1.username AS usernameAdmin,
    p.idUser AS idPetugas, 
    u2.username AS usernamePetugas
FROM jadwalpengangkutan jp
LEFT JOIN admin a ON jp.idAdmin = a.idAdmin
LEFT JOIN users u1 ON a.idUser = u1.idUser
LEFT JOIN petugas p ON jp.idPetugas = p.idPetugas
LEFT JOIN users u2 ON p.idUser = u2.idUser
 WHERE statusJadwal = 'done'");
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function acceptJadwalPengangkutan($id)
    {
        $result = mysqli_query($this->conn, "UPDATE " . $this->table . " SET statusJadwalPengangkutan = 'accept' WHERE idJadwalPengangkutan = '" . $id . "'");
        if ($result) {
            $data = [
                "status" => true,
                "message" => "Jadwal Pengangkutan accepted",
            ];
            return $data;
        } else {
            $data = [
                "status" => false,
                "message" => "Jadwal Pengangkutan not accepted",
            ];
            return $data;
        }
    }

    public function rejectJadwalPengangkutan($id)
    {
        $result = mysqli_query($this->conn, "UPDATE " . $this->table . " SET statusJadwalPengangkutan = 'reject' WHERE idJadwalPengangkutan = '" . $id . "'");
        if ($result) {
            $data = [
                "status" => true,
                "message" => "Jadwal Pengangkutan rejected",
            ];
            return $data;
        } else {
            $data = [
                "status" => false,
                "message" => "Jadwal Pengangkutan not rejected",
            ];
            return $data;
        }
    }

    public function create($data, $idAdmin)
    {
        $date = date('Y-m-d H:i:s');
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES (null,'" . $data["idPetugas"] . "', $idAdmin, '$date', 'assigned')");
        $id = mysqli_query($this->conn, "SELECT idJadwalPengangkutan FROM " . $this->table . " WHERE tglJadwalPengangkutan = '$date'");
        $id = mysqli_fetch_assoc($id);

        if ($result) {
            $result = [
                "status" => true,
                "message" => "Jadwal Pengangkutan created successfully",
                "data" => [
                    "idJadwalPengangkutan" => $id["idJadwalPengangkutan"],
                    "idPetugas" => $data["idPetugas"],
                    "idAdmin" => $idAdmin,
                    "tglJadwalPengangkutan" => $date,
                    "statusJadwalPengangkutan" => 'assigned'
                ]
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Jadwal Pengangkutan creation failed",
            ];
            return $result;
        }
    }

    public function getByIdPetugas($id)
    {
        $result = mysqli_query($this->conn, "SELECT 
    jp.*, 
    a.idUser AS adminUserID, 
    u1.username AS adminUsername,
    p.idUser AS petugasUserID, 
    u2.username AS petugasUsername
FROM jadwalpengangkutan jp
LEFT JOIN admin a ON jp.idAdmin = a.idAdmin
LEFT JOIN users u1 ON a.idUser = u1.idUser
LEFT JOIN petugas p ON jp.idPetugas = p.idPetugas
LEFT JOIN users u2 ON p.idUser = u2.idUser
WHERE p.idUser = '$id' 
AND (statusJadwalPengangkutan = 'assigned' 
OR statusJadwalPengangkutan = 'on progress' 
OR statusJadwalPengangkutan = 'need accept')");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return [
                "status" => true,
                "message" => "Jadwal Pengangkutan found",
                "data" => $data
            ];
        } else {
            $data = [
                "status" => false,
                "message" => "Jadwal Pengangkutan not found",
            ];
            return $data;
        }
    }

    public function getByIdPetugasSelesai($id)
    {
        $result = mysqli_query($this->conn, "SELECT 
    jp.*, 
    a.idUser AS adminUserID, 
    u1.username AS adminUsername,
    p.idUser AS petugasUserID, 
    u2.username AS petugasUsername
FROM jadwalpengangkutan jp
LEFT JOIN admin a ON jp.idAdmin = a.idAdmin
LEFT JOIN users u1 ON a.idUser = u1.idUser
LEFT JOIN petugas p ON jp.idPetugas = p.idPetugas
LEFT JOIN users u2 ON p.idUser = u2.idUser
WHERE p.idUser = '$id' 
AND (statusJadwalPengangkutan != 'assigned' 
OR statusJadwalPengangkutan != 'on progress')");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return [
                "status" => true,
                "message" => "Jadwal Pengangkutan found",
                "data" => $data
            ];
        } else {
            $data = [
                "status" => false,
                "message" => "Jadwal Pengangkutan not found",
            ];
            return $data;
        }
    }


    public function setStatusJadwalPengangkutan($id, $status)
    {
        $result = mysqli_query($this->conn, "UPDATE " . $this->table . " SET statusJadwalPengangkutan = '" . $status . "' WHERE idJadwalPengangkutan = '" . $id . "'");
        if ($result) {
            $data = [
                "status" => true,
                "message" => "Status Jadwal Pengangkutan updated successfully",
            ];
            return $data;
        } else {
            $data = [
                "status" => false,
                "message" => "Status Jadwal Pengangkutan update failed",
            ];
            return $data;
        }
    }
}
