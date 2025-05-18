 <?php
/*session_start();
require_once 'bd.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
        header("Location: index.php");
        exit;
    } else {
        $errors[] = "Credenciales inválidas.";
    }
}*/
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
    <h1 class="title-text text-center mb-4">Iniciar sesión</h1>
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

    <p class="signup-link text-center">¿No tenés cuenta? <a href="/restaurant/signup">Registrate</a></p>
  </div>
</body>
</html>
