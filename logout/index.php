<?php
session_start();

// Guardar el rol antes de destruir la sesión
$isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

// Destruir la sesión
session_destroy();

// Redirigir según el rol
if ($isAdmin) {
    header("Location: /restaurant");
} else {
    header("Location: ../index.php");
}
exit;
