<?php
require_once __DIR__ . '/../middleware/auth.php';
include("../bd.php");

$user = $_SESSION['user'] ?? null;

if (!$user) {
  header('Location: ../auth/login.php');
  exit;
}

$userId = $user['id'];

// Obtener órdenes más recientes primero
$stmt = $connection->prepare("SELECT * FROM orders WHERE user_id = :userId ORDER BY created_at DESC");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis compras</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php include '../components/navbar.php'; ?>

<div class="container mt-5">
  <h1 class="mb-4">Historial de compras</h1>

  <?php if (empty($orders)): ?>
    <p>No realizaste ninguna compra aún.</p>
  <?php else: ?>
    <?php foreach ($orders as $order): ?>
      <div class="card mb-4">
        <div class="card-header">
          <strong>Fecha:</strong> <?= htmlspecialchars($order['created_at']) ?> -
          <strong>Total:</strong> $<?= number_format($order['total'], 2) ?>
        </div>
        <div class="card-body">
          <ul>
            <?php
              $stmtItems = $connection->prepare("SELECT * FROM order_items WHERE order_id = :orderId");
              $stmtItems->bindParam(':orderId', $order['id']);
              $stmtItems->execute();
              $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
              foreach ($items as $item):
            ?>
              <li><?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?> - $<?= $item['price'] ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
</body>
</html>