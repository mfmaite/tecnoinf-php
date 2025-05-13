<style>
  .menuContainer {
    display: flex;
    gap: 20px;
    padding-top: 40px;
  }

  .menuHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;

    .menuTitle {
      color: white;
      font-size: 2rem;
      font-family: "Ultra", serif;
    }
  }
</style>

<?php
  include("../bd.php");
  $query=$connection->prepare("SELECT * FROM `menu`");
  $query->execute();
  $menus=$query->fetchAll(PDO::FETCH_ASSOC);

  // Get isAdmin parameter, default to false if not set
  $isAdmin = isset($isAdmin) ? $isAdmin : false;
?>

<div class="container">
  <div class="menuHeader">
    <h2 class="menuTitle">Lista de Menús</h2>
    <?php if ($isAdmin): ?>
      <button class="btn btn-primary">Agregar Menú</button>
    <?php endif; ?>
  </div>

  <div class="menuContainer">
    <?php foreach ($menus as $menu) { ?>
      <?php
        $imageSrc = $menu['photoUrl'];
        $menuName = $menu['name'];
        $menuPrice = $menu['price'];
        include '../components/menu-card.php';
      ?>
    <?php } ?>
  </div>
</div>
