<?php

// generaFactura.php
include __DIR__ . "/../config/conexion.php";
require_once __DIR__ . '/../vendor/autoload.php';

$conn = Conexion::getInstance()->getConnection();

//Obteniendo el numero de Recibo para generar el pdf
$codiReci = isset($_GET['codiReci']) ? $_GET['codiReci'] : null;

// Llamar al procedimiento almacenado
$sql = "CALL sp_obtener_informacion_factura($codiReci)";
$result = $conn->query($sql);

if ($result) {
    // Obtener la primera fila como array asociativo
    $row = $result->fetch_assoc();
} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
    exit; // Salir del script en caso de error
}

// Cerrar la conexión a la base de datos
$conn->close();

// Generar el PDF
ob_start();
include(dirname(__FILE__) . '/factura_plantilla.php');
$html = ob_get_clean();

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('chroot', realpath(''));
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter', 'portrait');

$dompdf->render();

$dompdf->stream('Recibo_' . $codiReci, array('Attachment' => false));
?>
