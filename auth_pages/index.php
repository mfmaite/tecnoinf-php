<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión - Pachepé</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/fonts.css">

  <style>
    body {
      background-color: #495057;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background-color: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .btn-primary {
      width: 100%;
      margin-top: 1rem;
    }

    .signup-link {
      text-align: center;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1 class="title-text text-center mb-4">Iniciar sesión</h1>
    <?php foreach ($errors as $error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>

    <form method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="signup-link">¿No tenés cuenta? <a href="signup.php">Registrate</a></p>
  </div>
</body>
</html>
