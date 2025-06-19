<nav class="navbar navbar-expand-lg mx-3 px-4 mt-4 rounded shadow-lg bg-white border border-1 border-opacity-25">
    <div class="container-fluid">
        <!-- Logo & Brand -->
        <a class="navbar-brand d-flex align-items-center gap-3 text-primary" href="<?= site_url('/home') ?>">
            <img src="<?= base_url('/upload/logo.png') ?>" alt="Apollo XIII Logo"
                class="img-fluid" style="max-width: 120px; min-width: 120px;">
            <span class="fw-bold fs-4">Apollo XIII Pastry Shop</span>
        </a>

        <!-- Toggler for small devices -->
        <button class="navbar-toggler shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right Side of Navbar -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <div class="ms-auto d-flex align-items-center gap-3">
                
                <?php if (session()->get('isLoggedIn')): ?>

                    <!-- 🔔 Notification -->
                    <a href="<?= site_url('/notification') ?>" class="btn btn-light position-relative rounded-circle shadow-sm"
                       style="width: 42px; height: 42px;">
                        <i class="bi bi-bell fs-5 text-dark"></i>
                        <?php if ($notificationCount > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                  style="font-size: 0.65rem;">
                                <?= esc($notificationCount) ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <!-- 🛒 Cart -->
                    <a href="<?= site_url('/cart') ?>" class="btn btn-light position-relative rounded-circle shadow-sm"
                       style="width: 42px; height: 42px;">
                        <i class="bi bi-cart fs-5 text-dark"></i>
                        <?php if ($countItems > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                  style="font-size: 0.65rem;">
                                <?= esc($countItems) ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <!-- 👤 Profile Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle fw-medium px-3 rounded-pill" type="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i><?= esc(session()->get('name')) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= site_url('/profile') ?>"><i class="bi bi-person-lines-fill me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= site_url('/user/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>

                <?php else: ?>
                    <!-- 📝 Register & 🔓 Login -->
                    <a href="<?= site_url('/register') ?>" class="btn btn-outline-primary rounded-pill fw-semibold px-4 shadow-sm">
                        <i class="bi bi-person-plus-fill me-1"></i> Register
                    </a>
                    <a href="<?= site_url('/login') ?>" class="btn btn-success rounded-pill fw-semibold px-4 shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>
