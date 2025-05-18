<?php
require_once __DIR__ . '/../middleware/auth.php';
isAlreadyLoggedIn();

session_start();
include("../bd.php");

$errors = [];

if ($_POST) {
    try {
        $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $query = $connection->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = [
                'email' => $user['email'],
                'role' => $user['role']
            ];
            $_SESSION['loggedIn'] = true;

            if ($user['role'] == 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php");
            }
            exit;
        } else {
            $errors[] = "Email o contraseña incorrectos";
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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
        <h1 class="title-text text-center mb-4">Iniciar sesión</h1>
        <form method="POST">
            <div class="formFieldComponent">
                <label class="formLabel" for="email">Email</label>
                <input class="formInput"
                       type="email"
                       name="email"
                       value="<?= htmlspecialchars($email ?? '') ?>"
                       required>
            </div>

            <div class="formFieldComponent">
                <label class="formLabel" for="password">Contraseña</label>
                <input class="formInput"
                       type="password"
                       name="password"
                       required>
            </div>

            <div class="form-group buttonContainer">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>

        <p class="signup-link text-center">¿No tenés cuenta? <a href="../signup">Registrarse</a></p>
    </div>
</body>
</html>
