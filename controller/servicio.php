<?php
require_once __DIR__ . '/../config/conexion.php';

class servicio
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexion::getInstance()->getConnection();
    }

    public function listarServiciosPorCliente($codiClie)
    {
        $stmt = $this->conn->prepare("CALL sp_listar_servicios(?)");
        $stmt->bind_param("s", $codiClie);

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
        $stmt = $this->conn->prepare("CALL sp_listar_historial_pagos(?)");
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

    public function verificarEstadoCuenta($codiServ)
    {
        $stmt = $this->conn->prepare("CALL sp_verificar_estado_cuenta(?)");
        $stmt->bind_param("s", $codiServ);

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Error en la consulta: " . $this->conn->error);
        }

        $rowCount = $result->num_rows;

        $stmt->close();

        return $rowCount === 0;
    }
}
