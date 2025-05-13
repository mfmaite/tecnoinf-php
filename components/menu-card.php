<style>
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
</style>

<div class="card menuCard" style="width: 18rem;">
  <img
    src="<?= htmlspecialchars($imageSrc) ?>"
    class="card-img-top menuImage"
    alt="<?= htmlspecialchars($menuName) ?>"
  >
  <div class="card-body">
    <span class="title"><?= htmlspecialchars($menuName) ?></span>
    <span class="price">$<?= htmlspecialchars($menuPrice) ?></span>
  </div>
</div>
