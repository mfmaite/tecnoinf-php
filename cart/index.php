<?php
  session_start();
  require_once __DIR__ . '/../middleware/auth.php';
  requireNonAdmin();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use Dotenv\Dotenv;

  require __DIR__ . '/../vendor/autoload.php';

  $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
  $dotenv->load();

  $cart = $_SESSION['cart'] ?? [];
  include("../bd.php");

  if ($_POST) {
    $user = $_SESSION['user'] ?? null;

    if (!$user || empty($cart)) {
        header('Location: ../cart/index.php');
        exit;
    }

    $userId = $user['id'];
    $now = date('Y-m-d H:i:s');

    // --- Calcular total ---
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    try {
      // --- Insertar orden ---
      $query = $connection->prepare("INSERT INTO orders (user_id, total, created_at) VALUES (:user_id, :total, :created_at)");
      $query->bindParam(':user_id', $userId);
      $query->bindParam(':total', $total);
      $query->bindParam(':created_at', $now);
      $query->execute();

      $orderId = $connection->lastInsertId();

      // --- Insertar ítems ---
      foreach ($cart as $item) {
          $queryItem = $connection->prepare("INSERT INTO order_items (order_id, product_id, name, quantity, price) VALUES (:order_id, :product_id, :name, :quantity, :price)");
          $queryItem->bindParam(':order_id', $orderId);
          $queryItem->bindParam(':product_id', $item['id']);
          $queryItem->bindParam(':name', $item['name']);
          $queryItem->bindParam(':quantity', $item['quantity']);
          $queryItem->bindParam(':price', $item['price']);
          $queryItem->execute();
      }

      // --- Preparar y enviar mail ---
      $mail = new PHPMailer(true);

      try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USERNAME'];
        $mail->Password   = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['SMTP_USERNAME'], 'Tecnoinf');
        $mail->addAddress($user['email']);  // destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de compra';

        $message = "<h1>Gracias por tu compra!</h1>";
        $message .= "<p>Detalles de tu compra:</p><ul>";
        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $message .= "<li>" . htmlspecialchars($item['name']) . " x " . $item['quantity'] . " - $" . $subtotal . "</li>";
        }
        $message .= "</ul><p><strong>Total: $" . $total . "</strong></p>";

        $mail->Body = $message;

        $mail->send();
        error_log("Correo enviado con éxito a " . $user['email']);
      } catch (Exception $e) {
          error_log("Error al enviar correo: {$mail->ErrorInfo}");
          $error = "No se pudo enviar el correo de confirmación. Intenta más tarde.";
      }

      // --- Vaciar carrito ---
      $_SESSION['cart'] = [];

      // --- Redirigir ---
      header('Location: /restaurant/cart/success/');
      exit;
    } catch (PDOException $e) {
      error_log("Error processing order: " . $e->getMessage());
      $error = "Hubo un error al procesar tu orden. Por favor intenta nuevamente.";
    }
  }

  // Generate CSRF token if not exists
  if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
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
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger errorContainer"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="container">
            <h2 class="h2">Carrito</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

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
            <?php if (!empty($cart)): ?>
                <div class="text-center mt-4">
                    <form method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <button type="submit" class="btn btn-success">Finalizar compra</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
