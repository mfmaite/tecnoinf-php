<style>
  .menuCard {
    min-width: 250px;
    position: relative;
  }

  .card-body {
    display: flex;
    flex-direction: column;
  }

  .title {
    font-size: 1.2rem;
    font-weight: bold;
    font-family: "Ultra", serif;
  }

  .price {
    font-family: "Kirang Haerang", system-ui;
    font-size: 1.5rem;
    display: flex;
    justify-content: flex-end;
  }

  .menuImage {
    height: 200px;
    object-fit: cover;
  }

  .delete-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: rgba(220, 53, 69, 0.9);
    color: white !important;
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 1;
    text-decoration: none;
  }

  .delete-btn:hover {
    background-color: rgba(220, 53, 69, 1);
    transform: scale(1.1);
    text-decoration: none;
  }
</style>

<div class="card menuCard" style="width: 18rem;">
  <?php if (isset($isAdmin) && $isAdmin): ?>
    <a href="/restaurant/admin/menu/delete/?id=<?= urlencode($menu['id']) ?>&name=<?= urlencode($menuName) ?>&price=<?= urlencode($menuPrice) ?>&image=<?= urlencode($imageSrc) ?>"
       class="delete-btn">
      ×
    </a>
  <?php endif; ?>
  <img
    src="<?= htmlspecialchars(!empty($imageSrc) ? $imageSrc : '../images/default-menu.jpg') ?>"
    class="card-img-top menuImage"
    alt="<?= htmlspecialchars($menuName) ?>"
  >
  <div class="card-body">
    <span class="title"><?= htmlspecialchars($menuName) ?></span>
    <span class="price">$<?= htmlspecialchars($menuPrice) ?></span>
  </div>
</div>
