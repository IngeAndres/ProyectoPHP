    <?php
    require_once '../model/cambiarClave.php';
    require_once('../controller/jwtoken.php');
    require_once('../config/config.php');

    session_start();

    if (!isset($_COOKIE['cliente_token'])) {
        http_response_code(401);
        echo json_encode(array("message" => "Cookie de autorización no encontrada."));
        exit;
    }

    $token = $_COOKIE['cliente_token'];

    $jwt = new jwtoken(SECRET_KEY);

    $userData = [
        'codiClie' => $_SESSION['cliente_id'],
        'numeDocu' => $_SESSION['cliente_docu'],
    ];

    $decodedToken = $jwt->verificarToken($token, $userData);

    if ($decodedToken) {
        // Obtener datos del POST
        $nuevaClave = $_POST['nuevaClave'];
        $claveActual = $_POST['claveActual'];

        $cambiarClaveObj = new cambiarClave();

        $resultado =  $cambiarClaveObj->cambiarClave($_SESSION['cliente_id'], $nuevaClave, $claveActual);

        echo json_encode(["resultado" => $resultado]);
    } else {
        http_response_code(401);
        echo json_encode(array("message" => "Token de autorización inválido."));
        exit;
    }
