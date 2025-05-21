<?php
session_start();
include("../bd.php");

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit('Usuario no logueado');
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = $_POST['menu_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if (!$menu_id || !in_array($action, ['add', 'remove'])) {
        http_response_code(400);
        exit('Datos inválidos');
    }

    if ($action === 'add') {
        $stmt = $conn->prepare("INSERT IGNORE INTO favoritos (user_id, menu_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $user_id, $menu_id);
        $stmt->execute();
        echo "Agregado a favoritos";
    } elseif ($action === 'remove') {
        $stmt = $conn->prepare("DELETE FROM favoritos WHERE user_id = ? AND menu_id = ?");
        $stmt->bind_param('ii', $user_id, $menu_id);
        $stmt->execute();
        echo "Eliminado de favoritos";
    }
}
?>