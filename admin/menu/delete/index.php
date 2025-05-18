<?php
  require_once __DIR__ . '../../../../middleware/auth.php';
  requireAdmin();

// Obtener los parámetros de la URL
$menuId = isset($_GET['id']) ? $_GET['id'] : '';
$menuName = isset($_GET['name']) ? $_GET['name'] : '';
$menuPrice = isset($_GET['price']) ? $_GET['price'] : '';
$menuImage = isset($_GET['image']) ? $_GET['image'] : '';

// Si no hay ID, redirigir a la página de menús
if (empty($menuId)) {
    header("Location: /restaurant/admin/menu/");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eliminar Menú - Pachepé</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ultra&display=swap" rel="stylesheet">

  <style>
    .delete-container {
      max-width: 600px;
      margin: 40px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .page-title {
      font-family: "Ultra", serif;
      color: #333;
      margin-bottom: 30px;
      text-align: center;
    }

    .menu-preview {
      text-align: center;
      margin-bottom: 20px;
      padding: 20px;
      border: 1px solid #dee2e6;
      border-radius: 4px;
    }

    .menu-image {
      max-width: 200px;
      height: 200px;
      object-fit: cover;
      margin-bottom: 15px;
      border-radius: 4px;
    }

    .menu-name {
      font-family: "Ultra", serif;
      color: #333;
      margin: 10px 0;
    }

    .menu-price {
      font-size: 1.5rem;
      color: #666;
    }
  </style>
</head>

<body class="bg-light">
  <?php include '../../../components/navbar.php'; ?>

  <div class="container">
    <div class="delete-container">
      <h2 class="page-title">Eliminar Menú</h2>

      <div class="menu-preview">
        <img src="<?= htmlspecialchars(!empty($menuImage) ? $menuImage : '../../../images/default-menu.jpg') ?>"
             alt="<?= htmlspecialchars($menuName) ?>"
             class="menu-image">
        <h3 class="menu-name"><?= htmlspecialchars($menuName) ?></h3>
        <p class="menu-price">$<?= htmlspecialchars(number_format((float)$menuPrice, 2)) ?></p>
      </div>

      <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i>
        <strong>¡Advertencia!</strong> Esta acción eliminará permanentemente este menú.
      </div>

      <form action="process.php" method="POST" class="mt-4">
        <input type="hidden" name="menu_id" value="<?= htmlspecialchars($menuId) ?>">

        <div class="form-group text-center">
          <a href="/restaurant/admin/" class="btn btn-secondary mr-2">Cancelar</a>
          <button type="submit" class="btn btn-danger">Eliminar Menú</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
