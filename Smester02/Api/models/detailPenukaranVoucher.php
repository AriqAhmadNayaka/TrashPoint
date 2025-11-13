<?php
class detailPenukaranVoucher
{
    private $conn;
    private $table = "detailpenukaranvoucher";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($idPenukaranVoucher, $idVoucher)
    {
        $result = mysqli_query($this->conn, "INSERT INTO " . $this->table . " VALUES ('','$idPenukaranVoucher', '$idVoucher')");
        if ($result) {
            $result = [
                "status" => true,
                "message" => "Detail penukaran voucher created successfully",
            ];
        }
    }
}
