    <section>
        <div class="container pb-5">
            <!-- Notice Here -->
            <div class="card shadow-sm mb-4 border-warning">
                <div class="card-body bg-warning bg-opacity-25 text-center rounded-3">
                    <h6 class="fw-bold text-dark mb-2">
                        📢 Advance Order Reminder
                    </h6>
                    <p class="mb-0 text-secondary">
                        We want to make sure your order arrives exactly when you need it!
                        <br>
                        <span class="text-danger fw-semibold">Please place your order at least <u>two (2) days in advance</u></span>
                        so we can prepare everything perfectly for you. 🎂✨
                    </p>
                </div>
            </div>
            <h4 class="mt-4  text-center"><strong>Menu</strong></h4>
            <form class="my-4 w-25" action="<?= site_url('/home') ?>" method="post">
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
            <div class="row">

                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                                    data-mdb-ripple-color="light">
                                    <img src="<?= base_url($product['ImagePath']) ?>" class="w-100" style="height: 250px; object-fit: fill;" alt="Product Image" />
                                    <a href="#!">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100 mt-2">
                                                <h5><span class="badge bg-primary ms-2">New</span></h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                        </div>
                                    </a>
                                </div>

                                <div class="card-body">
                                    <h6 class="text-start fs-4">
                                        &#x20B1;<?= esc($product['Price']) ?>
                                        <small class="text-muted">
                                            <?php
                                                $catName = strtolower($product['CategoryName'] ?? '');
                                                if ($catName === 'cakes') {
                                                    echo ' / Pan';
                                                } elseif ($catName === 'kakanin') {
                                                    echo ' / 100 pcs';
                                                }
                                            ?>
                                        </small>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="#" class="text-decoration-none text-dark">
                                            <h5 class="card-title mb-3"><?= esc($product['ProductName']) ?></h5>
                                        </a>
                                        <span class="text-secondary">
                                            <?= esc($product['CategoryName'] ?? 'Uncategorized') ?>
                                        </span>
                                    </div>
                                    <button class="btn btn-success w-100 mt-3" data-bs-toggle="modal" data-bs-target="#addToCartModal<?= esc($product['ProductID']) ?>">
                                        <i class="bi bi-cart"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?= view('users/modal/_addToCart', ['product' => $product]) ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="bg-secondary p-2 rounded mx-3">
                        <p class="text-center mb-0 text-white fw-bold">No Product Available</p>
                    </div>
                <?php endif; ?>
            </div>
    </section>

