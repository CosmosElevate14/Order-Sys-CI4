<div class="modal fade" id="editModal<?= $product['ProductID'] ?>" tabindex="-1" aria-labelledby="editLabel<?= $product['ProductID'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/product/edit/' . $product['ProductID']) ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel<?= $product['ProductID'] ?>">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="ProductName" value="<?= esc($product['ProductName']) ?>" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <select class="form-select" name="category" aria-label="Default select example">
                  <option value="" disabled <?= empty($selectedCategory) ? 'selected' : '' ?>>Select Category</option>    
                  <option value="all" <?= $selectedCategory === 'all' ? 'selected' : '' ?>>All</option>    
                  <?php foreach ($category as $cat): ?>
                      <option value="<?= esc($cat['CategoryID']) ?>" 
                          <?= $product['CategoryID'] == $cat['CategoryID'] ? 'selected' : '' ?>>
                          <?= esc($cat['CategoryName']) ?>
                      </option>
                  <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label>Price</label>
            <input type="number" name="Price" value="<?= esc($product['Price']) ?>" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="ImagePath" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>