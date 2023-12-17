<?php
require_once('Conexion.php');

class Cliente
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getInstance()->getConnection();
    }

    public function listarClientes()
    {
        $query = "SELECT * FROM cliente";
        $result = $this->conexion->query($query);

        if ($result->num_rows > 0) {
            $clientes = array();

            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }

            return $clientes;
        } else {
            return false;
        }
    }
}
?>