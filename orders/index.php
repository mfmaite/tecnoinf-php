<?php
  include("../bd.php");
  session_start();
  require_once __DIR__ . '/../middleware/auth.php';
  requireNonAdmin();

  $orders = [];
  $user = $_SESSION['user'] ?? [];

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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Pedidos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../CSS/fonts.css" type="text/css">
  <link rel="stylesheet" href="../CSS/cart-page.css" type="text/css">
</head>
<body>
<?php include '../components/navbar.php'; ?>

<div class="cartContainer">
  <div class="container">
    <h2 class="h2 text-white mb-4">Historial de Pedidos</h2>

    <?php if (empty($orders)): ?>
      <p class="text-center mt-4 text-white">No realizaste ningún pedido aún.</p>
    <?php else: ?>
      <div class="orders-list">
        <?php foreach ($orders as $order): ?>
          <div class="order-card mb-4">
            <div class="order-header">
              <div class="order-date">
                <i class="fas fa-calendar-alt"></i>
                <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
              </div>
              <div class="order-total">
                <i class="fas fa-dollar-sign"></i>
                <?= number_format($order['total'], 2) ?>
              </div>
            </div>
            <div class="order-items">
              <?php
                $stmtItems = $connection->prepare("SELECT * FROM order_items WHERE order_id = :orderId");
                $stmtItems->bindParam(':orderId', $order['id']);
                $stmtItems->execute();
                $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
                foreach ($items as $item):
              ?>
                <div class="order-item">
                  <span class="item-name"><?= htmlspecialchars($item['name']) ?></span>
                  <span class="item-quantity">x<?= $item['quantity'] ?></span>
                  <span class="item-price">$<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
.cartContainer {
  background-color: #495057;
  min-height: calc(100vh - 100px);
  padding: 60px 0;
  display: flex;
  flex-direction: column;
}

.container {
  flex: 1;
  overflow-y: auto;
  max-height: calc(100vh - 160px);
  padding-right: 15px;
}

/* Custom Scrollbar Styling */
.container::-webkit-scrollbar {
  width: 8px;
}

.container::-webkit-scrollbar-track {
  background: transparent;
}

.container::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 4px;
}

.container::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.3);
}

.orders-list {
  margin: 0 auto;
}

.order-card {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  padding: 20px;
  color: white;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.order-date, .order-total {
  font-size: 1.1em;
  font-weight: 500;
}

.order-items {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.order-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 0;
}

.item-name {
  flex: 1;
}

.item-quantity {
  margin: 0 15px;
  color: rgba(255, 255, 255, 0.7);
}

.item-price {
  font-weight: 500;
}

@media (max-width: 576px) {
  .order-header {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }

  .order-item {
    flex-direction: column;
    text-align: center;
    gap: 5px;
  }

  .item-quantity {
    margin: 5px 0;
  }
}
</style>

<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>
