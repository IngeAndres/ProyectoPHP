<?php
require_once('controller/login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeDocu = $_POST['numeDocu'];
    $passClie = hash('sha256', $_POST['passClie']);
    $login = new login();

    if ($login->iniciarSesion($numeDocu, $passClie)) {
        $token = $_SESSION['cliente_token'];
        setcookie('cliente_token', $token, time() + 3600, '/');
        header("Location: principal.php");
        exit();
    } else {
        echo '<script>alert("Usuario y/o contraseña incorrectos");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inicio de Sesión</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="https://www.econocable.com/wp-content/uploads/2022/01/cropped-logo-500x500-1-32x32.png">
    <link rel="apple-touch-icon" href="https://www.econocable.com/wp-content/uploads/2022/01/cropped-logo-500x500-1-180x180.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
        }

        .container-fluid {
            height: 100vh;
            display: flex;
        }

        .col-md-6 {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .contact-info {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
            z-index: 2;
        }

        .contact-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-info p {
            font-size: 16px;
            margin: 0;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0">
                <img src="assets/img/sergio-zhukov-ae__8IOF0Cs-unsplash.jpg" alt="Fondo" class="img-fluid w-100 h-100">
                <!--<div class="contact-info">
                    <h2>Contacto</h2>
                    <p>Llámanos (01) 641 8000</p>
                    <p>ventasdigitales@econocable.com</p>
                </div>-->
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="container">

                    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center">

                                    <div class="card mb-3">

                                        <div class="card-body">

                                            <div class="d-flex justify-content-center py-4">
                                                <img src="assets/img/logo-econocable-1.png" alt="Logo" style="width: 300px; height: auto;">
                                            </div><!-- End Logo -->

                                            <div class="pb-2">
                                                <h5 class="card-title text-center pb-0 fs-4">Ingrese a su cuenta</h5>
                                                <p class="text-center small">Ingrese su N° de documento y
                                                    contraseña para
                                                    iniciar sesión</p>
                                            </div>

                                            <form method="post" action="" class="row g-3 needs-validation" novalidate>
                                                <div class="col-12">
                                                    <label for="numeDocu" class="form-label">N° Documento</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text" id="inputGroupPrepend">
                                                            <i class="fas fa-id-card"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="numeDocu" name="numeDocu" required>
                                                        <div class="invalid-feedback">Por favor ingrese su N° de documento</div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="passClie" class="form-label">Contraseña</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text" id="inputGroupPrepend">
                                                            <i class="fas fa-key"></i>
                                                        </span>
                                                        <input type="password" class="form-control" id="passClie" name="passClie" required>
                                                        <div class="invalid-feedback">Por favor ingrese su contraseña</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                        <label class="form-check-label" for="rememberMe">Recordarme</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary w-100" type="submit" style="background-color: #781f82; border: 2px solid #781f82;">Iniciar
                                                            sesión</button>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <p class="small mb-0">¿No tienes una cuenta? <a href="#">Crea una
                                                            cuenta</a></p>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                </div>
                </main>
            </div>
            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        </div>
    </div>
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
</body>

</html>