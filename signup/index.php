<?php
  require_once __DIR__ . '/../middleware/auth.php';
  isAlreadyLoggedIn();

  include("../bd.php");
  $errors = [];

  if ($_POST) {
   try {
      $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
      $password = isset($_POST['password']) ? $_POST['password'] : '';

      // Crear el hash de la contraseña
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
      $stmt->execute([$email]);

      if ($stmt->fetch()) {
          $errors[] = "Ya existe un usuario con ese email.";
      } else {
        $query = $connection->prepare("INSERT INTO users (email, password_hash, role) VALUES (:email, :password, 'user')");

        $query->bindParam(':email', $email);
        $query->bindParam(':password', $passwordHash);

        $query->execute();

        $userId = $connection->lastInsertId();

        $getUserQuery = $connection->prepare("SELECT * FROM users WHERE id = :id");
        $getUserQuery->bindParam(':id', $userId);
        $getUserQuery->execute();
        $user = $getUserQuery->fetch(PDO::FETCH_ASSOC);

        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = [
            'email' => $user['email'],
            'role' => $user['role']
        ];

        if ($user['role'] === 'admin') {
            header("Location: /restaurant/admin/index.php");
        } else {
            header("Location: /restaurant/index.php");
        }
        exit;
      }
    } catch (PDOException $e) {
      $errors[] = "Error en la base de datos: " . $e->getMessage();
    } catch (Exception $e) {
      $errors[] = "Error inesperado: " . $e->getMessage();
    }
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

  <div class="homeContainer">
      <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger errorContainer"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    <div class="overlay"> </div>
  </div>

  <div class="loginContainer">
    <h1 class="subTitle text-center mb-4">Registrarse</h1>
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

