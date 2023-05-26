<?php

require_once 'C:\xampp\htdocs\novedades\config\connection.php';

class DBConnect extends DBAbstractModel
{
    public function __construct()
    {
        parent::connect();
    }

    public function __destruct()
    {
        parent::closeConnection();
    }
    public function select($query)
    {
        return $this->conn->query($query);
    }

}
