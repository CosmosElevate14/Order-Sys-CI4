<?php foreach ($category as $cat): ?>
<div class="modal fade" id="deleteCategory<?= $cat['CategoryID'] ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('/admin/category/delete/' . $cat['CategoryID']) ?>" method="post">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Delete Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete <strong><?= esc($cat['CategoryName']) ?></strong>?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Yes, Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php endforeach; ?>