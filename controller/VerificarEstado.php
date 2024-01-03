<?php
require_once '../config/config.php';
require_once '../model/Servicio.php';
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
    if (isset($_POST['codiServ'])) {
        $codiServ = $_POST['codiServ'];

        $clienteServicio = new Servicio();
        $resultado = $clienteServicio->verificarEstadoCuenta($codiServ);

        header('Content-Type: application/json');
        echo json_encode($resultado);
    }
} else {
    header('Location: ../index.php');
    session_destroy();
    exit;
}
