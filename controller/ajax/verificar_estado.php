<?php
require_once('../servicio.php');

if (isset($_POST['codiServ'])) {
    $codiServ = $_POST['codiServ'];

    $clienteServicio = new servicio();
    $resultado = $clienteServicio->verificarEstadoCuenta($codiServ);

    // Devolver resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($resultado);
}
