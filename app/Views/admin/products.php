<main class="app-main">
    <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Products CRUD</h3>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Maintenance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                    <form class="my-4 w-25" action="<?= site_url('/admin/products') ?>" method="post">
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select" name="category" aria-label="Default select example">
                                <option value="" disabled <?= empty($selectedCategory) ? 'selected' : '' ?>>Select Category</option>    
                                <option value="all" <?= $selectedCategory === 'all' ? 'selected' : '' ?>>All</option>    
                                <?php foreach ($category as $cat): ?>
                                    <option value="<?= esc($cat['CategoryID']) ?>" 
                                        <?= $selectedCategory == $cat['CategoryID'] ? 'selected' : '' ?>>
                                        <?= esc($cat['CategoryName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-primary btn-sm" type="submit"><i class="bi bi-funnel"></i></button>
                        </div>
                    </form>
                    <div class="">
                        <div class="d-flex align-items-center justify-content-between pe-3">
                            <button data-bs-target="#addProduct" data-bs-toggle="modal" class="btn btn-primary ms-auto"><span class="bi bi-plus"></span> Add Product</button>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top:10px;">
                <?php if (!empty($products)): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Photo</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <a href="">
                                            <img src="<?= base_url($product['ImagePath']) ?>" height="30px" width="40px">
                                        </a>
                                    </td>
                                    <td><?= esc($product['ProductName']) ?></td>
                                    <td>&#x20B1;<?= esc($product['Price']) ?></td>
                                    <td>
                                        <button data-bs-target="#editModal<?= $product['ProductID'] ?>" data-bs-toggle="modal" class="btn btn-success btn-sm">
                                            <span class="bi bi-pencil"></span> Edit
                                        </button> 
                                        <button data-bs-target="#deleteModal<?= $product['ProductID'] ?>" data-bs-toggle="modal" class="btn btn-danger btn-sm">
                                            <span class="bi bi-trash"></span> Delete
                                        </button>      
                                    </td>
                                </tr>

                                <?= view('admin/modal/_editProduct', ['product' => $product]) ?>
                                <?= view('admin/modal/_deleteProduct', ['product' => $product]) ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <div class="bg-secondary p-2 rounded mx-3">
                            <p class="text-center mb-0 text-white fw-bold">No Product Available</p>
                        </div>
                    <?php endif; ?>
                </div>
        </div>
    </div>
    <?= view('admin/modal/_addProduct') ?>
</main>