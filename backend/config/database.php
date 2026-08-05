<?php

class Database
{
    private $host = "sql200.infinityfree.com";
private $db_name = "if0_42584461_fashionhub";
private $username = "if0_42584461";
private $password = "6jr0Cgq0KNN1A3U";

    public $conn;

    public function connect()
    {
        $this->conn = null;

        try
        {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
        catch(PDOException $e)
        {
            die("Database Connection Failed : " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>