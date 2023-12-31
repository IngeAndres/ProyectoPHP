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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Deudas</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Card and Table Section -->
                    <div class="card">
                        <div id="informacionServicio" class="card-body">
                            <!-- Aquí se mostrará la información del servicio -->
                        </div>
                    </div>
                    <!-- End Card and Table Section -->
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Deudas:</h5>
                            <div id="deudasContainer">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div>
            <?php include 'view/inc/modal.php'; ?>
        </div>

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i>
    </a>

    <!-- Vendor JS Files -->
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
    <script src="view/js/deudas.js"></script>
    <script src="view/js/cambiarClave.js"></script>
</body>

</html>