<?php
  include("../../../bd.php");

  // Get URL parameters
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $name = isset($_GET['name']) ? $_GET['name'] : '';
  $price = isset($_GET['price']) ? $_GET['price'] : '';
  $image = isset($_GET['image']) ? $_GET['image'] : '';

  if ($_POST) {
    $name=(isset($_POST['name'])) ? $_POST['name'] : '';
    $price=(isset($_POST['price'])) ? $_POST['price'] : '';
    $photo=(isset($_POST['photo'])) ? $_POST['photo'] : '';

    $query=$connection->prepare("UPDATE `menus` SET `name`=:name, `price`=:price, `photoUrl`=:photoUrl WHERE id=:id");

    $query->bindParam(':name', $name);
    $query->bindParam(':price', $price);
    $query->bindParam(':photoUrl', $photo);
    $query->bindParam(':id', $id);

    $query->execute();

    header("Location:../../index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Menú - Pachepé</title>

  <link rel="stylesheet" href="../menu.css" type="text/css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ultra&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kirang+Haerang&display=swap" rel="stylesheet">

  <style>
    .form-container {
      max-width: 600px;
      margin: 40px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .page-title {
      font-family: "Ultra", serif;
      color: #333;
      margin-bottom: 30px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .preview-image {
      max-width: 200px;
      margin-top: 10px;
      display: none;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <?php include '../../../components/navbar-admin.php'; ?>

  <div class="newMenuContainer">
    <div class="form-container container">
      <h2 class="page-title">Editar Menú</h2>

      <form id="newMenuForm" enctype="multipart/form-data" action="" method="post">
        <div class="form-group">
          <label for="menu-name">Nombre del menú</label>
          <input type="text"
            class="form-control"
            id="menu-name"
            name="name"
            required
            value="<?php echo htmlspecialchars($name); ?>"
            placeholder="Ingrese el nombre del plato">
        </div>

        <div class="form-group">
          <label for="menu-price">Precio del menú</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input type="number"
              class="form-control"
              id="menu-price"
              name="price"
              step="0.01"
              required
              value="<?php echo htmlspecialchars($price); ?>"
              placeholder="0.00">
          </div>
        </div>

        <div class="form-group">
          <label for="menu-photo">Link a la Foto</label>
          <div class="custom-file">
            <input type="text"
              class="form-control"
              id="menu-photo"
              name="photo"
              value="<?php echo htmlspecialchars($image); ?>"
              placeholder="Ingrese el link a la foto">
          </div>
        </div>

        <div class="form-group text-center">
          <a href="/restaurant/admin/" class="btn btn-secondary mr-2">Cancelar</a>
          <button type="submit" class="btn btn-primary">Guardar Menú</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
