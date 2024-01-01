<?php
require_once '../config/conexion.php';

class Servicio
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexion::getInstance()->getConnection();
    }

    public function listarServiciosPorCliente($codiClie)
    {
        $codiClie = $this->conn->real_escape_string($codiClie);

        $stmt = $this->conn->prepare("CALL sp_listar_servicios(?)");
        $stmt->bind_param("s", $codiClie);

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Error en la consulta: " . $this->conn->error);
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
        $codiServ = $this->conn->real_escape_string($codiServ);

        $stmt = $this->conn->prepare("CALL sp_listar_historial_pagos(?)");
        $stmt->bind_param("s", $codiServ);

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Error en la consulta: " . $this->conn->error);
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
        $codiServ = $this->conn->real_escape_string($codiServ);

        $stmt = $this->conn->prepare("CALL sp_verificar_estado_cuenta(?)");
        $stmt->bind_param("s", $codiServ);

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Error en la consulta: " . $this->conn->error);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();

        return [
            'status' => count($data) > 0,
            'data' => $data,
        ];
    }
}
