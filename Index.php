<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

<?php

require_once 'php/LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logiUsua = $_POST['logiUsua'];
    $passUsua = hash('sha256', $_POST['passUsua']);

    $loginController = new LoginController();

    if ($loginController->iniciarSesion($logiUsua, $passUsua)) {
        echo "Inicio de sesión exitoso";
    } else {
        echo "Inicio de sesión fallido";
    }
}
?>

  <form method="post" action="">
    <h2>Iniciar sesión</h2>
    <label for="logiUsua">Usuario:</label>
    <input type="text" id="logiUsua" name="logiUsua" required>

    <label for="passUsua">Contraseña:</label>
    <input type="password" id="passUsua" name="passUsua" required>

    <button type="submit">Iniciar sesión</button>
  </form>

</body>
</html>
