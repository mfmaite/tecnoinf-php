<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pachepé</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php include '../components/navbar.php'; ?>

    <div class="menuListContainer">
      <?php
        include '../components/favorites-list.php'; ?>
    </div>
</body>
</html>

<style>
  .menuListContainer {
    background-color: #495057;
    min-height: calc(100vh - 100px);
    padding: 60px 0;
  }
</style>
