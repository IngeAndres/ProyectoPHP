<?php
require_once '../config/config.php';
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
    header('Content-Type: application/json');
    echo json_encode(['status' => 'Token is valid']);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    session_destroy();
    exit;
}