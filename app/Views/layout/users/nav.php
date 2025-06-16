<nav class="navbar navbar-expand-lg mx-3 px-5 mt-3">
            <div class="container-fluid">

                <a class="navbar-brand text-primary" href="<?= site_url('/home') ?>">
                    <img class="w-25 rounded img-fluid" src="<?= base_url('/upload/logo.png') ?>" alt="">
                    Apollo XIII Store
                </a>
                <div class="d-flex w-100">
                    
                    <div class="d-flex align-items-center mb-0 gap-3 fs-4 pe-2 ms-auto">
                        
                        <?php if (session()->get('isLoggedIn')): ?>
                            <a role="button" class="text-dark position-relative btn btn-lg" href="<?= site_url('/notification') ?>">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fs-7" style="font-size: 10px;">
                                    <?= esc($notificationCount) ?>
                                </span>
                            </a>
                            <a role="button" class="text-dark position-relative btn btn-lg" href="<?= site_url('/cart') ?>">
                                <i class="bi bi-cart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fs-7" style="font-size: 10px;">
                                    <?= esc($countItems) ?>
                                </span>
                            </a>
                            <ul class="navbar-nav me-5">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person fs-4"></i> <?= esc(session()->get('name')) ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= site_url('/profile') ?>">Profile</a></li>
                                        <li><a class="dropdown-item text-danger" href="<?= site_url('/user/logout') ?>">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <?php else: ?>
                                <ul class="navbar-nav fs-5">
                                    <li class="nav-item me-2">
                                        <a role="button" class="btn btn-primary" href="<?= site_url('/register') ?>">Register</a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="button" class="btn btn-success" href="<?= site_url('/login') ?>">Login</a>
                                    </li>
                                </ul>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>