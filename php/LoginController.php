<?php
require_once 'Conexion.php';
require_once 'JWToken.php';

class LoginController {
    private $db;
    private $jwt;

    public function __construct() {
        $this->db = Conexion::getInstance();
        $this->jwt = new JWToken('tu_clave_secreta', 'tu_issuer_claim', 'tu_audience_claim');
    }

    public function iniciarSesion($logiUsua, $passUsua) {
        $conn = $this->db->getConnection();

        $query = "SELECT * FROM usuario WHERE logiUsua = ? AND passUsua = ?";
        $stmt = $conn->prepare($query);

        $stmt->bind_param("ss", $logiUsua, $passUsua);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            session_start();

            $_SESSION['usuario_id'] = $usuario['codiUsua'];
            $_SESSION['usuario_nombre'] = $usuario['logiUsua'];

            $token = $this->jwt->generarToken($usuario['logiUsua']);
            $_SESSION['usuario_token'] = $token;

            header('Location: principal.html');
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}
?>
