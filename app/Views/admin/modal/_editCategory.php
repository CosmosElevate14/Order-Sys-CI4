<?php foreach ($category as $cat): ?>
<div class="modal fade" id="editCategory<?= $cat['CategoryID'] ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('/admin/category/edit/' . $cat['CategoryID']) ?>" method="post">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="CategoryName" value="<?= esc($cat['CategoryName']) ?>" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="bi bi-pencil"></i> Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php endforeach; ?>