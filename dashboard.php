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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
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

    <!-- Main Content Section -->
    <main id="main" class="main">
        <!-- Estado de la deuda Section -->
        <section class="section">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div id="deudaCuentaCard" class="card border-primary d-flex flex-column h-100">
                        <div class="card-header"></div>
                        <div class="card-body text-primary flex-grow-1">
                            <h5 class="card-title">Cargando...</h5>
                            <div id="enlaceDeudas" class="d-flex justify-content-end align-items-center">
                                <a href="#" id="deudasLink" class="btn btn-link text-primary">
                                    Ver deudas <i class=" fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <div id="estadoServicioCard" class="card border-primary d-flex flex-column h-100">
                        <div class="card-header"></div>
                        <div class="card-body text-primary flex-grow-1">
                            <h5 class="card-title">Cargando...</h5>
                        </div>
                    </div>
                </div>
                <!-- End Card Section -->
            </div>
        </section>
        <div>
            <?php include 'view/inc/modal.php'; ?>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
    <script src="view/js/dashboard.js"></script>
    <script src="view/js/cambiarClave.js"></script>
</body>

</html>