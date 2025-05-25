<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /restaurant/auth_pages/login.php");
        exit;
    }
}

#Se usa de la siguiente manera en la pagina que lo requiera

/* <?php
require_once __DIR__ . '/../auth/auth.php';
requireLogin();
?> */