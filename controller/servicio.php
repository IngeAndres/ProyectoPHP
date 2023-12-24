<?php
require_once 'config/conexion.php';

class servicio
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexion::getInstance()->getConnection();
    }

    public function listarServiciosPorCliente($razonSocial)
    {
        $stmt = $this->conn->prepare("CALL sp_ListarServicios(?)");
        $stmt->bind_param("s", $razonSocial);

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Error en la consulta: " . $this->conn->error);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();

        return $data;
    }

    public function listarHistorialPago($codiServ)
    {
        $stmt = $this->conn->prepare("CALL sp_ListarHistorialPago(?)");
        $stmt->bind_param("s", $codiServ);

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Error en la consulta: " . $this->conn->error);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();

        return $data;
    }
}
