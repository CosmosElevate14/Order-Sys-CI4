<div class="modal fade" id="deleteModal<?= $product['ProductID'] ?>" tabindex="-1" aria-labelledby="deleteLabel<?= $product['ProductID'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/product/delete/' . $product['ProductID']) ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteLabel<?= $product['ProductID'] ?>">Delete Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete "<strong><?= esc($product['ProductName']) ?></strong>"?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>