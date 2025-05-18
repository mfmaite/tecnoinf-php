<?php
/*session_start();
require_once 'bd.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = 'user'; // por defecto, a menos que quieras permitir admins desde aquí

    if (empty($email) || empty($password)) {
        $errors[] = "Email y contraseña son obligatorios.";
    } else {
        // Verificar si el usuario ya existe
        $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = "Ya existe un usuario con ese email.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, ?)");
            $stmt->execute([$email, $passwordHash, $role]);

            $_SESSION['user'] = [
                'email' => $email,
                'role' => $role
            ];

            header("Location: index.php");
            exit;
        }
    }
}*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
</head>
<body>
  <h1>Registro</h1>
  <?php foreach ($errors as $error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
  <?php endforeach; ?>

  <form method="POST">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Contraseña: <input type="password" name="password" required></label><br>
    <button type="submit">Registrarse</button>
  </form>
  <p>¿Ya tenés cuenta? <a href="login.php">Iniciar sesión</a></p>
</body>
</html>
