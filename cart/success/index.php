<?php
  session_start();
  require_once __DIR__ . '/../../middleware/auth.php';
  requireNonAdmin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compra Exitosa</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../../CSS/fonts.css" type="text/css">
</head>

<body>
    <?php include '../../components/navbar.php'; ?>

    <div class="successContainer">
        <div class="row justify-content-center width-100 pt-5">
            <div class="col-md-8 text-center">
                <h1 class="h2 mb-4">¡Gracias por tu compra!</h1>
                <p class="lead text-white">Tu orden ha sido procesada exitosamente.</p>
                <p class="text-white">Te hemos enviado un correo electrónico con los detalles de tu compra.</p>
                <a href="/restaurant" class="btn btn-primary mt-3">Volver al inicio</a>
            </div>
        </div>
    </div>
</body>
</html>

<style>
  .successContainer {
    background-color: #495057;
    height: calc(100vh - 100px);
    width: 100vw;
  }

  .width-100 {
    width: 100%;
  }
</style>
