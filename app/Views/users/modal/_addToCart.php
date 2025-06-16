<div class="modal fade" id="addToCartModal<?= esc($product['ProductID']) ?>" tabindex="-1" aria-labelledby="addToCartLabel<?= esc($product['ProductID']) ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= site_url('cart/add') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="addToCartLabel<?= esc($product['ProductID']) ?>">Add to Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Product: <?= esc($product['ProductName']) ?></p>
          <p>Price: &#x20B1;<?= esc($product['Price']) ?></p>
          <p>Category: <?= esc($product['CategoryName'] ?? 'Uncategorized') ?></p>
          <input type="hidden" name="product_id" value="<?= esc($product['ProductID']) ?>">
          <input type="hidden" name="product_price" value="<?= esc($product['Price']) ?>">
          <input type="hidden" name="product_name" value="<?= esc($product['ProductName']) ?>">
          
          <div class="mb-3">
            <label for="quantity<?= esc($product['ProductID']) ?>" class="form-label">Quantity:</label>
            <input type="number" name="quantity" id="quantity<?= esc($product['ProductID']) ?>" class="form-control" value="1" min="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add to Cart</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>