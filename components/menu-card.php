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
    display: flex;
    align-items: center;
    gap: 10px;
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

  .edit-btn {
    width: 15px;
    height: 15px;
    padding: 0;
    display: flex;
    border: none;
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .edit-btn:hover {
    transform: scale(1.1);
  }

  .edit-btn svg {
    width: 100%;
    height: 100%;
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
    <div class="title">
      <?= htmlspecialchars($menuName) ?>
      <?php if (isset($isAdmin) && $isAdmin): ?>
        <a href="/restaurant/admin/menu/edit/?id=<?= urlencode($menu['id']) ?>&name=<?= urlencode($menuName) ?>&price=<?= urlencode($menuPrice) ?>&image=<?= urlencode($imageSrc) ?>"
           class="edit-btn"
           title="Editar menú">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" fill="#0F0F0F"/>
          </svg>
        </a>
      <?php endif; ?>
    </div>
    <span class="price">$<?= htmlspecialchars($menuPrice) ?></span>
  </div>
</div>
