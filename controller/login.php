<?php
require_once 'config/conexion.php';
require_once 'jwtoken.php';

class login
{

    private $conn;
    private $jwt;

    public function __construct()
    {
        $this->conn = Conexion::getInstance()->getConnection();
        $this->jwt = new JWToken();
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
            $_SESSION['cliente_nombre'] = $cliente['raznSociClie'];

            $token = $this->jwt->generarToken($cliente['numeDocu']);
            $_SESSION['cliente_token'] = $token;

            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}
