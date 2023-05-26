<?php

try {
    abstract class DBAbstractModel
    {
        protected $host = 'localhost';
        protected $username = 'root';
        protected $password = '';
        protected $database = 'empresa';
        protected $conn;

        public function connect()
        {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                die("Error de conexión: " . $this->conn->connect_error);
            }
        }

        public function closeConnection()
        {
            $this->conn->close();
        }
    }
} catch (\Throwable $th) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>