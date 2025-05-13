<?php
  include("../bd.php");
  $query=$connection->prepare("SELECT * FROM `menu`");
  $query->execute();
  $menus=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="../CSS/home-admin.css" type="text/css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ultra&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kirang+Haerang&display=swap" rel="stylesheet">
</head>

<body>
    <?php include '../components/navbar-admin.php'; ?>

    <div class="homeContainer">
      <div class="container">
        <div class="menuHeader">
          <h2 class="menuTitle">Lista de Menús</h2>
          <button class="btn btn-primary">Agregar Menú</button>
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
</body>
</html>
