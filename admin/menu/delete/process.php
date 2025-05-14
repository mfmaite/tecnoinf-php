<?php
include("../../../bd.php");

if ($_POST) {
    $menuId = (isset($_POST['menu_id'])) ? $_POST['menu_id'] : '';

    try {
      $deleteQuery = $connection->prepare("DELETE FROM menus WHERE id = :id");
      $deleteQuery->bindParam(':id', $menuId);
      $deleteQuery->execute();

      header("Location: /restaurant/admin/");
    } catch(Exception $e) {
      header("Location: /restaurant/admin/?error=" . urlencode($e->getMessage()));
    }
} else {
    header("Location: /restaurant/admin/");
}
exit();
?>
