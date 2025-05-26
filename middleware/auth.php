<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
}

function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function requireNonAdmin() {
    if (!isLoggedIn()) {
        echo "No estás autenticado";
        header("Location: /restaurant/login/");
        exit;
    }

    if (isAdmin()) {
        echo "No eres admin";
        header("Location: /restaurant/admin/");
        exit;
    }
}

function requireAdmin() {
    if (!isLoggedIn()) {
        header("Location: /restaurant/login/");
        exit;
    }

    if (!isAdmin()) {
        header("Location: /restaurant/");
        exit;
    }
}

function isAlreadyLoggedIn() {
    if (isLoggedIn()) {
        if (isAdmin()) {
            header("Location: /restaurant/admin/");
        } else {
            header("Location: /restaurant/");
        }
        exit;
    }
}
?>
