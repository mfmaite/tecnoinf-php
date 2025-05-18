<?php
  session_start();
  require_once __DIR__ . '/../middleware/auth.php';
  requireNonAdmin();

  $cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="../CSS/cart-page.css" type="text/css">
  <link rel="stylesheet" href="../CSS/fonts.css" type="text/css">
</head>

<body>
    <?php include '../components/navbar.php'; ?>

    <div class="cartContainer">
        <div class="container">
            <h2 class="h2">Carrito</h2>

            <?php if (empty($cart)): ?>
                <p class="text-center mt-4 text-white">El carrito está vacío.</p>
            <?php else: ?>
                <ul class="px-0 mt-5">
                    <?php foreach ($cart as $item): ?>
                      <?php
                          $menuId = $item['id'];
                          $image = $item['image'];
                          $menuName = $item['name'];
                          $menuPrice = $item['price'];
                          $quantity = $item['quantity'];
                          include '../components/cart-item.php';
                        ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
