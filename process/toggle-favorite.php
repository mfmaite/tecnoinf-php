<?php
session_start();
include("../bd.php");

if (!isset($_SESSION['user']['id'])) {
    http_response_code(403);
    exit('Usuario no logueado');
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = $_POST['menu_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if (!$menu_id || !in_array($action, ['add', 'remove'])) {
        http_response_code(400);
        exit('Datos inválidos');
    }

    try {
        if ($action === 'add') {
            $check = $connection->prepare("SELECT COUNT(*) FROM favoritos WHERE user_id = ? AND menu_id = ?");
            $check->execute([$user_id, $menu_id]);
            $exists = $check->fetchColumn();

            if (!$exists) {
                $stmt = $connection->prepare("INSERT INTO favoritos (user_id, menu_id) VALUES (?, ?)");
                $stmt->execute([$user_id, $menu_id]);
            }

            echo "Agregado a favoritos";
        } elseif ($action === 'remove') {
            $stmt = $connection->prepare("DELETE FROM favoritos WHERE user_id = ? AND menu_id = ?");
            $stmt->execute([$user_id, $menu_id]);
            echo "Eliminado de favoritos";
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Error en base de datos: " . $e->getMessage();
    }
}
