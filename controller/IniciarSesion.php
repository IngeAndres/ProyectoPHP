<?php
require_once '../model/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeDocu = $_POST['numeDocu'];
    $passClie = $_POST['passClie'];

    $cliente = new Cliente();

    if ($cliente->iniciarSesion($numeDocu, $passClie)) {
        $token = $_SESSION['cliente_token'];
        setcookie('cliente_id', $_SESSION['cliente_id'], time() + 3600, '/');
        setcookie('cliente_token', $token, time() + 3600, '/');
        echo json_encode(["resultado" => "ok"]);
    } else {
        echo json_encode(["resultado" => "error"]);
    }
}
