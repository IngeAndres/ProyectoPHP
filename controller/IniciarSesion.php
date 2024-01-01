<?php
require_once '../model/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeDocu = $_POST['numeDocu'];
    $passClie = $_POST['passClie'];  // Ya es un hash SHA256

    $cliente = new Cliente();

    if ($cliente->iniciarSesion($numeDocu, $passClie)) {
        $token = $_SESSION['cliente_token'];
        setcookie('cliente_token', $token, time() + 3600, '/');
        echo json_encode(["resultado" => "ok"]);
    } else {
        // Autenticación fallida, enviar respuesta JSON
        echo json_encode(["resultado" => "error"]);
    }
}
