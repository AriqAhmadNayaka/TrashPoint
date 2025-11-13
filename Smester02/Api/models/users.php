<?php
class users
{
    private $conn;
    private $table = 'users';
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

    public function create($data)
    {

        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES (null, '" . $data["username"] . "', '" . $data["email"] . "', '" . $data["password"] . "', '" . $data["phoneNumber"] . "', 'masyarakat', 'active')");

        $idUser = mysqli_query($this->conn, "SELECT idUser FROM " . $this->table . " WHERE email = '" . $data["email"] . "'");
        $idUser = mysqli_fetch_assoc($idUser);

        if ($result) {
            $result = [
                "status" => true,
                "message" => "User created successfully",
                "data" => [
                    "idUser" => $idUser["idUser"],
                    "username" => $data["username"],
                    "email" => $data["email"],
                    "password" => $data["password"],
                    "phoneNumber" => $data["phoneNumber"],
                    "role" => "masyarakat",
                    "status" => "active",
                ]
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "User creation failed",
            ];
            return $result;
        }
    }

    public function login($data)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM " . $this->table . " WHERE username = '" . $data["username"] . "' AND password = '" . $data["password"] . "'");


        if ($row = mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $result = [
                "status" => true,
                "message" => "Login successful",
                "data" => [
                    "idUser" => $row["idUser"],
                    "username" => $row["username"],
                    "email" => $row["email"],
                    "password" => $row["password"],
                    "phoneNumber" => $row["phoneNumber"],
                    "role" => $row["role"],
                    "status" => $row["status"],
                ]
            ];
            return $result;
        } else {
            $result = [
                "status" => false,
                "message" => "Invalid email or password",
            ];
            return $result;
        }
    }
}
