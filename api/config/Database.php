<?php

class Database
{
    //DB Params
    private $host = 'localhost:3306';
    private $db_name = 'social_media';
    private $username = '';
    private $password = '';

    private $conn;

    //DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }
        return $this->conn;
    }
}
