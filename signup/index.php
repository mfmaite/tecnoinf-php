<?php
  include("../bd.php");

  if ($_POST) {
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $password = (isset($_POST['password'])) ? $_POST['password'] : '';
    $password=password_hash($password, PASSWORD_DEFAULT);

    $query = $connection->prepare("INSERT INTO users (email, password_hash, role) VALUES (:email, :password, 'user')");

    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);

    $query->execute();

    header("Location:../index.php");
  }
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../CSS/fonts.css">
  <link rel="stylesheet" href="../CSS/home.css">
  <link rel="stylesheet" href="../CSS/auth-pages.css">
</head>
<body>
  <?php include '../components/navbar.php'; ?>

  <?php foreach ($errors as $error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
  <?php endforeach; ?>

  <div class="homeContainer">
    <div class="overlay"> </div>
  </div>

  <div class="loginContainer">
    <h1 class="title-text text-center mb-4">Registrarse</h1>
    <form method="POST">
      <div class="formFieldComponent">
        <label class="formLabel" for="email">Email</label>
        <input class="formInput" type="email" name="email" required>
      </div>

      <div class="formFieldComponent">
        <label class="formLabel" for="password">Contraseña</label>
        <input class="formInput" type="password" name="password" required>
      </div>

      <div class="form-group buttonContainer">
        <button type="submit" class="btn btn-primary">Entrar</button>
      </div>
    </form>

    <p class="signup-link text-center">¿Ya tenés cuenta? <a href="/restaurant/login">Iniciar sesión</a></p>
  </div>
</body>
</html>

