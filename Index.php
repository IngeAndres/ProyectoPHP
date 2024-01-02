<!DOCTYPE html>
<html lang="es">

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

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

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
    <link href="view/css/style-index.css" rel="stylesheet">

    <style>
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #loadingLogo {
            text-align: center;
        }

        #loadingIndicator {
            border: 4px solid #781f82;
            border-top: 8px solid transparent;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 0.5s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Antes de cargar la página -->
    <div id="loadingOverlay">
        <div id="loadingLogo">
            <img src="view/img/logo-econocable-1.png" alt="Logo" style="width: 300px; height: auto;">
        </div>
        <div id="loadingIndicator"></div>
    </div>

    <div class="container-fluid" id="mainContent" style="display: none;">
        <div class="row">
            <!-- Imagen de fondo solo visible en dispositivos medianos y grandes -->
            <div class="col-md-6 d-none d-md-block p-0">
                <picture>
                    <!-- Imagen en formato WebP -->
                    <source srcset="view/img/background-1.webp" type="image/webp">

                    <!-- Alternativa en formato JPEG -->
                    <img src="view/img/background-1.jpg" alt="Fondo" class="img-fluid w-100 h-100">
                </picture>
            </div>

            <!-- Contenedor del formulario -->
            <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
                <div class="container">
                    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-8">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center py-4">
                                                <img src="view/img/logo-econocable-1.png" alt="Logo" style="width: 300px; height: auto;">
                                            </div><!-- End Logo -->
                                            <div class="pb-2">
                                                <h5 class="card-title text-center pb-0 fs-4">Ingrese a su cuenta</h5>
                                                <p class="text-center small">Ingrese su N° de documento y contraseña para iniciar sesión</p>
                                            </div>

                                            <!-- Formulario -->
                                            <form class="row g-3 needs-validation" novalidate>
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

                                                <div class="mt-3" id="alertError">
                                                    <div class="form-control form-control-user alert alert-danger alert-sm p-2 d-flex align-items-center" role="alert">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                        </svg>
                                                        <div id="mensajeError" class="text-center small">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="col-12">
                                                        <button id="iniciarSesion" class="btn btn-primary w-100" type="button">Iniciar sesión</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Fin del formulario -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
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
    <script src="view/js/index.js"></script>
    <script src="cryptojs/rollups/sha256.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.getElementById("loadingOverlay").style.display = "none";
                document.getElementById("loadingIndicator").style.display = "none";
                document.getElementById("loadingLogo").style.display = "none";
                document.getElementById("mainContent").style.display = "block";
            }, 100);
        });
    </script>
</body>

</html>