<?php
session_start();
$url_base = "http://localhost/restaurant/";

// Get the current page URL
$current_page = $_SERVER['REQUEST_URI'];
$is_home = strpos($current_page, '/restaurant/') !== false && strlen($current_page) <= strlen('/restaurant/') + 1;
$is_menu = strpos($current_page, '/restaurant/menu') !== false;
$is_login = strpos($current_page, '/restaurant/login') !== false;
?>

<link rel="stylesheet" href="<?php echo $url_base; ?>CSS/fonts.css">

<style>
  .navbarComponent {
    width: 100%;
    height: 100px;
  }

  .brandTitle {
    margin-right: 35px;
    font-size: 40px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbarComponent">
  <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin'): ?>
    <a class="navbar-brand brandTitle font-ultra" href="<?php echo $url_base;?>admin">ADMIN</a>
  <?php else: ?>
    <a class="navbar-brand brandTitle font-ultra" href="<?php echo $url_base;?>">PACHEPÉ</a>
  <?php endif; ?>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'user'): ?>
        <li class="nav-item <?php echo $is_menu ? 'active' : ''; ?>">
          <a class="nav-link font-ultra" href="<?php echo $url_base; ?>menu">Menú</a>
        </li>
      <?php endif; ?>

    </ul>

    <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['user']['role'])): ?>
        <li class="nav-item">
          <a class="nav-link font-ultra" href="<?php echo $url_base; ?>logout">Cerrar sesión</a>
        </li>
        <?php else: ?>
          <li class="nav-item <?php echo $is_login ? 'active' : ''; ?>">
            <a class="nav-link font-ultra" href="<?php echo $url_base; ?>login">Iniciar sesión</a>
          </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
