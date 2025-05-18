<li class="cart-item mb-3">
    <div class="row align-items-center bg-white p-3 rounded">
        <div class="col-3 col-md-2">
            <div class="cart-item-image">
                <img
                  src="<?= htmlspecialchars(!empty($image) ? $image : '../images/default-menu.jpg') ?>"
                  class="img-fluid rounded"
                >
            </div>
        </div>

        <div class="col-5 col-md-6">
            <h3 class="menu-title mb-2"><?= htmlspecialchars($menuName) ?></h3>
            <p class="menu-price mb-0">$<?= number_format($menuPrice, 2) ?></p>
        </div>

        <div class="col-4 col-md-4">
            <div class="quantity-controls d-flex align-items-center justify-content-end">
                <form action="/restaurant/process/update-cart-quantity.php" method="post" class="d-inline">
                    <input type="hidden" name="menu_id" value="<?= htmlspecialchars($menuId) ?>">
                    <input type="hidden" name="change" value="-1">
                    <button type="submit"
                            class="btn btn-outline-secondary btn-sm quantity-btn"
                      >
                        -
                    </button>
                </form>

                <span class="quantity-display mx-3"><?= $quantity ?></span>

                <form action="/restaurant/process/update-cart-quantity.php" method="post" class="d-inline">
                    <input type="hidden" name="menu_id" value="<?= htmlspecialchars($menuId) ?>">
                    <input type="hidden" name="change" value="1">
                    <button type="submit" class="btn btn-outline-secondary btn-sm quantity-btn">
                        +
                    </button>
                </form>
            </div>
        </div>
    </div>
</li>

<style>
.cart-item {
    list-style: none;
}

.cart-item-image {
    aspect-ratio: 1/1;
    overflow: hidden;
}

.cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.menu-title {
    font-family: 'Ultra', serif;
    font-size: 1.2rem;
    color: #2c3e50;
}

.menu-price {
    font-family: 'Kirang Haerang', cursive;
    font-size: 1.3rem;
    color: #e67e22;
}

.quantity-display {
    font-family: 'Ultra', serif;
    font-size: 1.1rem;
    min-width: 2rem;
    text-align: center;
}

.quantity-btn {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

@media (max-width: 768px) {
    .menu-title {
        font-size: 1rem;
    }

    .menu-price {
        font-size: 1.1rem;
    }

    .quantity-display {
        font-size: 1rem;
    }
}
</style>
