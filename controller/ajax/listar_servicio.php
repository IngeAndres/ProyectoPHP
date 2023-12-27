<?php
require_once '../servicio.php';

session_start();
$clienteId = $_SESSION['cliente_id'];
$servicio = new servicio();
$resultado = $servicio->listarServiciosPorCliente($clienteId);

echo json_encode($resultado);
