<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="<?= base_url('dashboard') ?>" class="brand-link">
            <span class="brand-text fw-light">APOLLO XIII STORE</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
                        <i class="nav-icon bi bi-graph-up"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-tools"></i>
                        <p>
                            Maintenance
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/products') ?>" class="nav-link">
                                <i class="nav-icon bi bi-box-seam"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/category') ?>" class="nav-link">
                                <i class="nav-icon bi bi-bucket"></i>
                                <p>Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-cart"></i>
                        <p>
                            Orders
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/orders/Pending') ?>" class="nav-link">
                                <i class="nav-icon bi bi-clock"></i>
                                <p>Pending</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/orders/Confirmed') ?>" class="nav-link">
                                <i class="nav-icon bi bi-cart-check"></i>
                                <p>Confirmed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/orders/Declined') ?>" class="nav-link">
                                <i class="nav-icon bi bi-cart-x"></i>
                                <p>Declined</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/customers') ?>" class="nav-link">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/sales') ?>" class="nav-link">
                        <i class="nav-icon bi bi-clipboard2-data"></i>
                        <p>Sales</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/logout') ?>" class="nav-link">
                        <i class="nav-icon bi bi-arrow-bar-left"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>