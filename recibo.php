<?php
session_start();

if (!isset($_SESSION['cliente_logueado'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    setcookie('cliente_id', '', time() - 3600, '/');
    setcookie('cliente_token', '', time() - 3600, '/');

    if (isset($_COOKIE['PHPSESSID'])) {
        setcookie('PHPSESSID', '', time() - 3600, '/');
    }

    header('Location: index.php');
    exit;
}

//Ontención de los datos 

include __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/vendor/autoload.php';

$conn = Conexion::getInstance()->getConnection();

$codiReci = isset($_GET['codiReci']) ? $_GET['codiReci'] : null;

$sql = "CALL sp_obtener_informacion_factura($codiReci)";
$result = $conn->query($sql);

if ($result) {
    // Obtener la primera fila como array asociativo
    $row = $result->fetch_assoc();
} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo</title>
    <link href="view/css/factura.css" rel="stylesheet">
    <?php include 'view/inc/link.php'; ?>
    <?php include 'view/inc/script.php'; ?>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <?php include 'view/inc/header.php'; ?>

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <?php include 'view/inc/sidebar.php'; ?>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <div class="container">

            <div class="title">
                <div class="receipt-info">
                    <p class="receipt-code">Recibo: <strong><?php echo $row['numeReci'] ?></strong></p>
                </div>
                <p><i class="bi bi-check-circle-fill"></i><?php echo $row['raznSociClie'] ?></p>
                <button class="btn btn-danger" id="btnDescargarPDF" data-codireci="<?php echo $codiReci; ?>">
                    <i class="bi bi-file-earmark-pdf-fill"></i> PDF</button>
            </div>
            <div class="invoice-details">
                <div>
                    <p>De:</p>
                    <p style="font-weight: bold;">ECONOCABLE PERÚ</p>
                    <p>Jr. Galvez 525, Barranca 15169</p>
                    <p>Teléfono: (01) 6418000</p>
                    <p>Email: ventasdigitales@econocable.com</p>
                </div>
                <div>
                    <p>Para:</p>
                    <p style="font-weight: bold;"><?php echo $row['raznSociClie'] ?></p>
                    <p><?php echo $row['direccion'] ?></p>
                    <p>Calular : <?php echo ($row['celuClie'] != null ? $row['celuClie'] : '-') ?></p>
                    <p>RUC/DNI : <?php echo $row['numeDocu'] ?></p>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>P.U</th>
                        <th>DSCTO</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row['codiConc'] ?></td>
                        <td>
                            <?php echo $row['nombConc'] ?> <br>
                            <?php echo $row['nombPlan'] ?> <br>
                            <?php echo $row['nombUbig'] ?>
                        </td>
                        <td>1.0</td>
                        <td>S/.<?php echo $row['montReci'] ?></td>
                        <td>0</td>
                        <td>S/.<?php echo $row['montReci'] ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="total">
                <p style="font-size: 18px; font-weight: bold; color: #3498db;">Importe total: S/.<?php echo $row['montReci'] ?></p>
            </div>

            <div>
                <p id="fecha"></p>
                <p id="hora"></p>
            </div>

            <footer>
                <p>Si tiene alguna pregunta sobre este recibo, comuníquese con nosotros.</p>
            </footer>
        </div>
    </main>


    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="view/js/cambiarClave.js"></script>
    <script src="view/js/factura.js"></script>
</body>

<script>
    // Obtener la fecha y hora actual
    var fechaHoraActual = new Date();

    // Formatear la fecha
    var optionsFecha = {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    };
    var fechaFormateada = fechaHoraActual.toLocaleDateString('es-ES', optionsFecha);

    // Formatear la hora
    var optionsHora = {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    };
    var horaFormateada = fechaHoraActual.toLocaleTimeString('es-ES', optionsHora);

    // Mostrar la fecha y hora actual en los elementos HTML correspondientes
    document.getElementById('fecha').textContent = 'Fecha: ' + fechaFormateada;
    document.getElementById('hora').textContent = 'Hora: ' + horaFormateada;
</script>


</html>