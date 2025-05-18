<?php
session_start();
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
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
</head>
<body>
  <h1>Iniciar sesión</h1>
  <?php foreach ($errors as $error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
  <?php endforeach; ?>

  <form method="POST">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Contraseña: <input type="password" name="password" required></label><br>
    <button type="submit">Entrar</button>
  </form>
  <p>¿No tenés cuenta? <a href="signup.php">Registrate</a></p>
</body>
</html>
