<?php
session_start();
require_once __DIR__ . '/../middleware/auth.php';
requireAdmin(); // o simplemente validar usuario si no es solo para admin

include_once __DIR__ . '/../bd.php';

$user = $_SESSION['user'] ?? null;
$cart = $_SESSION['cart'] ?? [];

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
$to = $user['email'];
$subject = "Confirmación de compra - Tecnoinf";
$headers = "From: no-reply@tecnoinf.com\r\nContent-Type: text/html; charset=UTF-8\r\n";

$message = "<h1>Gracias por tu compra, " . htmlspecialchars($user['username']) . "!</h1>";
$message .= "<p>Detalles de tu compra:</p><ul>";

foreach ($cart as $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $message .= "<li>" . htmlspecialchars($item['name']) . " x " . $item['quantity'] . " - $" . $subtotal . "</li>";
}
$message .= "</ul><p><strong>Total: $" . $total . "</strong></p>";

mail($to, $subject, $message, $headers);

// --- Vaciar carrito ---
$_SESSION['cart'] = [];

// --- Redirigir ---
header('Location: ../cart/success.php');
exit;
