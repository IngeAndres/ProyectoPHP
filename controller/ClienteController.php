<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/conexion.php';
require_once 'Token.php';


class ClienteController
{

    private $conn;
    private $jwt;

    public function __construct()
    {
        $this->conn = conexion::getInstance()->getConnection();
        $this->jwt = new Token(SECRET_KEY);
    }

    public function iniciarSesion($numeDocu, $passClie)
    {

        $query = "SELECT * FROM cliente WHERE numeDocu = ? AND passClie = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ss", $numeDocu, $passClie);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();

            session_start();

            $_SESSION['cliente_logueado'] = true;
            $_SESSION['cliente_id'] = $cliente['codiClie'];
            $_SESSION['cliente_docu'] = $cliente['numeDocu'];
            $_SESSION['cliente_nombre'] = $cliente['raznSociClie'];

            $token = $this->jwt->generarToken($cliente['codiClie'], $cliente['numeDocu']);
            $_SESSION['cliente_token'] = $token;

            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
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
