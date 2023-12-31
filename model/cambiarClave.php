<?php
require_once '../config/conexion.php';

class cambiarClave
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexion::getInstance()->getConnection();
    }

    public function cambiarClave($codiClie, $claveNueva, $claveAntigua)
    {
        $hashClaveNueva = hash('sha256', $claveNueva);
        $hashClaveAntigua = hash('sha256', $claveAntigua);
        $query = "UPDATE cliente SET passClie = ? WHERE codiClie = ? AND passClie = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $hashClaveNueva, $codiClie, $hashClaveAntigua);
        $stmt->execute();

        // Verificar cuántas filas fueron afectadas por la actualización
        $filasAfectadas = $stmt->affected_rows;

        $stmt->close();

        // Si al menos una fila fue afectada, consideramos la actualización como exitosa
        return $filasAfectadas > 0;
    }
}
