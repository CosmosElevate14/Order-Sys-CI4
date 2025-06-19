<section class="pt-5">
    <div class="container">

        <!-- 🔔 Advance Order Reminder -->
        <div class="alert alert-warning d-flex align-items-start gap-3 shadow-sm border-start border-4 border-danger rounded-4 p-4 mb-5">
            <i class="bi bi-exclamation-triangle-fill fs-2 text-danger"></i>
            <div>
                <h5 class="fw-bold text-dark mb-1">Advance Order Reminder</h5>
                <p class="mb-0 text-secondary">
                    We want to make sure your order arrives exactly when you need it!
                    <br>
                    <span class="text-danger fw-semibold">Please place your order at least <u>two (2) days in advance</u></span>
                    so we can prepare everything perfectly for you. 🎂✨
                </p>
            </div>
        </div>

        <!-- 🍽️ Menu Heading -->
        <h2 class="text-center fw-bold mb-4">Our Delicious Menu</h2>

        <!-- 🔍 Category Filter -->
        <form action="<?= site_url('/home') ?>" method="post" class="d-flex justify-content-center mb-5">
            <div class="input-group w-auto shadow-sm rounded-pill">
                <select name="category" class="form-select rounded-start-pill border-0 px-4 py-2" style="min-width: 200px;">
                    <option value="" disabled <?= empty($selectedCategory) ? 'selected' : '' ?>>Select Category</option>
                    <option value="all" <?= $selectedCategory === 'all' ? 'selected' : '' ?>>All</option>
                    <?php foreach ($category as $cat): ?>
                        <option value="<?= esc($cat['CategoryID']) ?>" <?= $selectedCategory == $cat['CategoryID'] ? 'selected' : '' ?>>
                            <?= esc($cat['CategoryName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-primary rounded-end-pill px-4" type="submit">
                    <i class="bi bi-funnel-fill"></i> Filter
                </button>
            </div>
        </form>

        <!-- 🧁 Product Grid -->
        <div class="row g-4">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow border-0 rounded-4 hover-shadow-sm">
                            <!-- Product Image -->
                            <div class="position-relative">
                                <img src="<?= base_url($product['ImagePath']) ?>" class="card-img-top rounded-top-4" style="height: 230px; object-fit: cover;" alt="<?= esc($product['ProductName']) ?>">
                                <span class="badge bg-primary position-absolute top-0 end-0 m-3 shadow-sm">New</span>
                            </div>

                            <!-- Product Info -->
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title mb-0"><?= esc($product['ProductName']) ?></h5>
                                    <span class="badge bg-light text-secondary small border">
                                        <?= esc($product['CategoryName'] ?? 'Uncategorized') ?>
                                    </span>
                                </div>

                                <h6 class="text-success fw-bold">
                                    &#x20B1;<?= esc($product['Price']) ?>
                                    <small class="text-muted fw-normal">
                                        <?php
                                            $cat = strtolower($product['CategoryName'] ?? '');
                                            echo $cat === 'cakes' ? '/ Pan' : ($cat === 'kakanin' ? '/ 100 pcs' : '');
                                        ?>
                                    </small>
                                </h6>

                                <!-- Add to Cart Button -->
                                <button class="btn btn-success w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#addToCartModal<?= esc($product['ProductID']) ?>">
                                    <i class="bi bi-cart-plus-fill"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add to Cart Modal -->
                    <?= view('users/modal/_addToCart', ['product' => $product]) ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-secondary text-center fw-bold">
                        No Products Available
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
