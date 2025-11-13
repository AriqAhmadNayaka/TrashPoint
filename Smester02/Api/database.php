<?php

class database
{
    private $conn;
    public function __construct($host, $user, $pass, $dbname)
    {
        $this->conn = mysqli_connect($host, $user, $pass, $dbname);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
