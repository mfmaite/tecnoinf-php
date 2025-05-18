<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['menu_id']) ? $_POST['menu_id'] : null;
    $change = isset($_POST['change']) ? (int)$_POST['change'] : 0;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    foreach ($_SESSION['cart'] as $key => &$item) {
        if ($item['id'] === $id) {
            $newQuantity = $item['quantity'] + $change;

            if ($newQuantity <= 0) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            } else {
                $item['quantity'] = $newQuantity;
            }
            break;
        }
    }

    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: /restaurant/cart/");
    }
    exit;
}
