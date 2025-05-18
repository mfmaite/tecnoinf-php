<?php
$url_base = "http://localhost/restaurant/";

// Get the current page URL
$current_page = $_SERVER['REQUEST_URI'];
$is_home = strpos($current_page, '/restaurant/') !== false && strlen($current_page) <= strlen('/restaurant/') + 1;
$is_menu = strpos($current_page, '/restaurant/menu') !== false;
?>

<style>
  .navbarComponent {
    width: 100%;
    height: 100px;
    font-family: "Ultra", serif;
  }

  .brandTitle {
    margin-right: 35px;
    font-size: 40px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbarComponent">
  <a class="navbar-brand brandTitle" href="<?php echo $url_base;?>">PACHEPÉ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php echo $is_menu ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo $url_base; ?>menu">Menú</a>
      </li>
    </ul>
  </div>
</nav>

<?php
require_once __DIR__ . '/../auth.php';
?>

<div class="ml-auto pr-4">
  <?php if (isLoggedIn()): ?>
    <span>Hola, <?= htmlspecialchars($_SESSION['user']['email']) ?>!</span>
    <a href="/restaurant/auth_pages/logout.php" class="btn btn-outline-danger ml-2">Logout</a>
  <?php else: ?>
    <a href="/restaurant/auth_pages/login.php" class="btn btn-outline-primary ml-2">Login</a>
    <a href="/restaurant/auth_pages/signup.php" class="btn btn-outline-secondary ml-2">Registrarse</a>
  <?php endif; ?>
</div>