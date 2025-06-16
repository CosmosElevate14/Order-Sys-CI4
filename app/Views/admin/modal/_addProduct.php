<!-- Add Product Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('/admin/product/add') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="ProductName" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="categoryID" aria-label="Default select example">
                            <option value="" disabled <?= empty($selectedCategory) ? 'selected' : '' ?>>Select Category</option>    
                            <?php foreach ($category as $cat): ?>
                                <option value="<?= esc($cat['CategoryID']) ?>" 
                                    <?= $selectedCategory == $cat['CategoryID'] ? 'selected' : '' ?>>
                                    <?= esc($cat['CategoryName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="Price" required>
                    </div>
                    <div class="mb-3">
                        <label for="ImagePath" class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="ImagePath" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Product</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
