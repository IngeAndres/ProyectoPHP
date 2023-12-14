<?php

class Conexion
{
    private static $instance;
    private $conn;

    private $server = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "carlosch_caja";

    private function __construct()
    {
        $this->conn = new mysqli($this->server, $this->user, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Conexión fallida - ERROR de conexión: " . $this->conn->connect_error);
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
?>
