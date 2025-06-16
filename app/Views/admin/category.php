<!-- Your main app body -->
<main class="app-main">
    <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Category CRUD</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Maintenance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
    </div>

    <!-- Your App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="">
                <div class="d-flex align-items-center justify-content-between pe-3">
                    <button data-bs-target="#addcategory" data-bs-toggle="modal" class="pull-right d-block btn btn-primary ms-auto"><span class="bi bi-plus"></span> Category</button>
                </div>
            </div>

            <div style="margin-top:10px;">
                <table class="table table-striped table-bordered">
                    <?php if (!empty($category)): ?>
                    <thead>
                        <th>Category Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                            <?php foreach ($category as $cat): ?>
                                <tr>
                                    <td><?= esc($cat['CategoryName']) ?></td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#editCategory<?= $cat['CategoryID'] ?>" class="btn btn-success btn-sm">
                                            <span class="bi bi-pencil"></span> Edit
                                        </button>
                                        <button data-bs-toggle="modal" data-bs-target="#deleteCategory<?= $cat['CategoryID'] ?>" class="btn btn-danger btn-sm">
                                            <span class="bi bi-trash"></span> Delete
                                        </button>
                                    </td>
                                </tr>
                                <?= view('admin/modal/_editCategory') ?>
                                <?= view('admin/modal/_deleteCategory') ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <div class="bg-secondary p-2 rounded mx-3">
                                <p class="text-center mb-0 text-white fw-bold">No Category Available</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?= view('admin/modal/_addCategory') ?>
</main>