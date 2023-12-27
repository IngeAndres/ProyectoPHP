<?php
require_once '../servicio.php';

if (isset($_GET['codiServ'])) {
    $codiServ = $_GET['codiServ'];

    $clienteServicio = new servicio();
    $resultado = $clienteServicio->listarHistorialPago($codiServ);

    // Devolver resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($resultado);
}
