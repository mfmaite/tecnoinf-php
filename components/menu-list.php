<?php
  session_start();
  include("../bd.php");
  $query=$connection->prepare("SELECT * FROM `menus`");
  $query->execute();
  $menus=$query->fetchAll(PDO::FETCH_ASSOC);

  $isAdmin = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin';
?>

<link rel="stylesheet" href="../CSS/fonts.css" type="text/css">

<div class="container">
  <div class="menuHeader">
    <h2 class="h2">Menú</h2>
    <?php if ($isAdmin): ?>
      <a href="/restaurant/admin/menu/new" class="btn btn-primary">
        Agregar Menú
      </a>
    <?php endif; ?>
  </div>

  <div class="menuContainer">
    <?php foreach ($menus as $menu) { ?>
      <?php
        $menuId = $menu['id'];
        $menuName = $menu['name'];
        $menuPrice = $menu['price'];
        $imageSrc = $menu['photoUrl'];
        include '../components/menu-card.php';
      ?>
    <?php } ?>
  </div>
</div>

<style>
  .menuContainer {
    display: flex;
    gap: 20px;
    padding-top: 40px;
    flex-wrap: wrap;
  }

  .menuHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
</style>
