    <?php
    require_once '../config/config.php';
    require_once '../model/Cliente.php';
    require_once '../jwt/Token.php';

    session_start();

    if (!isset($_COOKIE['cliente_token'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        session_destroy();
        exit;
    }

    $token = $_COOKIE['cliente_token'];

    $jwt = new Token(SECRET_KEY);

    $userData = [
        'codiClie' => $_SESSION['cliente_id'],
        'numeDocu' => $_SESSION['cliente_docu'],
    ];

    $decodedToken = $jwt->verificarToken($token, $userData);

    if ($decodedToken) {
        $codiClie = $_SESSION['cliente_id'];
        $nuevaClave = $_POST['nuevaClave'];
        $claveActual = $_POST['claveActual'];

        $cambiarClaveObj = new Cliente();

        $resultado =  $cambiarClaveObj->cambiarClave($codiClie, $nuevaClave, $claveActual);

        echo json_encode(["resultado" => $resultado]);
        session_destroy();
        setcookie('cliente_id', '', time() - 3600, '/');
        setcookie('cliente_token', '', time() - 3600, '/');

        if (isset($_COOKIE['PHPSESSID'])) {
            setcookie('PHPSESSID', '', time() - 3600, '/');
        }
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        session_destroy();
        exit;
    }
