    <?php
    require_once '../config/config.php';
    require_once '../model/Cliente.php';
    require_once '../jwt/Token.php';

    session_start();

    if (!isset($_COOKIE['cliente_token'])) {
        header('Location: ../index.php');
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
    } else {
        header('Location: ../index.php');
        session_destroy();
        exit;
    }
