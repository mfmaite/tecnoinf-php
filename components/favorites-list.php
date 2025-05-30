<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../bd.php");

$sortParam = $_GET['sort'] ?? 'name_asc';

$sortOptions = [
  'name_asc' => ['field' => 'name', 'order' => 'ASC'],
  'name_desc' => ['field' => 'name', 'order' => 'DESC'],
  'price_asc' => ['field' => 'price', 'order' => 'ASC'],
  'price_desc' => ['field' => 'price', 'order' => 'DESC']
];

if (!array_key_exists($sortParam, $sortOptions)) {
  $sortParam = 'name_asc';
}

$sortBy = $sortOptions[$sortParam]['field'];
$order = $sortOptions[$sortParam]['order'];

$isAdmin = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin';
$user_id = $_SESSION['user']['id'] ?? null;

if ($user_id) {
    $query = $connection->prepare("
        SELECT m.*, 1 AS is_favorite
        FROM menus m
        INNER JOIN favorites f ON m.id = f.menu_id
        WHERE f.user_id = ?
        ORDER BY m.$sortBy $order
    ");
    $query->execute([$user_id]);
} else {
    $query = $connection->prepare("
        SELECT m.*, 0 AS is_favorite
        FROM menus m
        ORDER BY m.$sortBy $order
    ");
    $query->execute();
}

$menus = $query->fetchAll(PDO::FETCH_ASSOC);

$favoritos = [];

if ($user_id) {
  $stmt = $connection->prepare("SELECT menu_id FROM favorites WHERE user_id = ?");
  $stmt->execute([$user_id]);
  $favoritos = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}
?>


<link rel="stylesheet" href="../CSS/fonts.css" type="text/css">

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h2">Favoritos</h2>
    <div class="d-flex align-items-center">
      <div class="sort-controls mr-3">
        <select class="custom-select" onchange="window.location.href = '?sort=' + this.value">
          <option value="name_asc" <?= $sortParam === 'name_asc' ? 'selected' : '' ?>>Nombre (A-Z)</option>
          <option value="name_desc" <?= $sortParam === 'name_desc' ? 'selected' : '' ?>>Nombre (Z-A)</option>
          <option value="price_asc" <?= $sortParam === 'price_asc' ? 'selected' : '' ?>>Precio (Menor a Mayor)</option>
          <option value="price_desc" <?= $sortParam === 'price_desc' ? 'selected' : '' ?>>Precio (Mayor a Menor)</option>
        </select>
      </div>

      <?php if ($isAdmin): ?>
        <a href="/restaurant/admin/menu/new" class="btn btn-primary">Agregar Menú</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="menuContainer">
    <?php foreach ($menus as $menu):
      $menuId = $menu['id'];
      $menuName = $menu['name'];
      $menuPrice = $menu['price'];
      $imageSrc = $menu['photoUrl'];
      $isFavorite = $menu['is_favorite'] == 1;
      include '../components/menu-card.php';
    endforeach; ?>
  </div>

  <?php if (empty($menus)): ?>
    <p class="text-center text-white">No has agregado ningún menú a favoritos.</p>
  <?php endif; ?>
</div>

<style>
  .menuContainer {
    display: flex;
    gap: 20px;
    padding-top: 40px;
    flex-wrap: wrap;
  }

  .h2 {
    color: white;
    font-family: 'Ultra', serif;
  }

  .custom-select {
    background-color: transparent;
    color: white;
    border: 2px solid white;
    border-radius: 4px;
    padding: 8px 12px;
    cursor: pointer;
    min-width: 200px;
    height: 2.8rem;
  }

  .custom-select option {
    background-color: rgb(105, 110, 114);
    color: white;
    padding: 8px;
  }
</style>
