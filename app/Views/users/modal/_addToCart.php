<div class="modal fade" id="addToCartModal<?= esc($product['ProductID']) ?>" tabindex="-1" aria-labelledby="addToCartLabel<?= esc($product['ProductID']) ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-sm border-0">
      <form action="<?= site_url('cart/add') ?>" method="post">
        <div class="modal-header bg-light border-bottom-0">
          <h5 class="modal-title fw-semibold" id="addToCartLabel<?= esc($product['ProductID']) ?>">
            Add to Cart
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <p class="mb-1"><strong>Product:</strong> <?= esc($product['ProductName']) ?></p>
            <p class="mb-1"><strong>Price:</strong> &#x20B1;<?= esc(number_format($product['Price'], 2)) ?></p>
            <p class="mb-3"><strong>Category:</strong> <?= esc($product['CategoryName'] ?? 'Uncategorized') ?></p>
          </div>

          <input type="hidden" name="product_id" value="<?= esc($product['ProductID']) ?>">
          <input type="hidden" name="product_price" value="<?= esc($product['Price']) ?>">
          <input type="hidden" name="product_name" value="<?= esc($product['ProductName']) ?>">

          <div class="mb-3">
            <label for="quantity<?= esc($product['ProductID']) ?>" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity<?= esc($product['ProductID']) ?>" class="form-control rounded" value="1" min="1" required>
          </div>
        </div>

        <div class="modal-footer border-top-0 d-flex flex-column gap-2">
          <button type="submit" class="btn btn-success w-100">
            Add to Cart
          </button>
          <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
