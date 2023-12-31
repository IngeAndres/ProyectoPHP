    <?php
        session_start();
        if (!isset($_SESSION['cliente_logueado'])) {
            header('Location: index.php');
            exit;
        }
        require_once '../config/conexion.php';
        require_once '../model/cambiarClave.php';

        // Obtener datos del POST
        $nuevaClave = $_POST['nuevaClave'];
        $claveActual = $_POST['claveActual'];

        $cambiarClaveObj = new cambiarClave();

        $resultado =  $cambiarClaveObj->cambiarClave($_SESSION['cliente_id'], $nuevaClave, $claveActual);

        echo json_encode(["resultado" => $resultado]);
    ?>