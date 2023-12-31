<?php
require_once('../servicio.php');
require_once('../jwtoken.php');
require_once('../../config/config.php');

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
    $clienteId = $_SESSION['cliente_id'];
    $servicio = new servicio();
    $resultado = $servicio->listarServiciosPorCliente($clienteId);

    header('Content-Type: application/json');
    echo json_encode($resultado);
} else {
    http_response_code(401);
    echo json_encode(array("message" => "Token de autorización inválido."));
    exit;
}
