<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Admin Dashboard</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end"></ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner d-flex align-items-start justify-content-between">
                            <div>
                                <h3><?= $pendingOrders > 0 ? $pendingOrders : 0 ?></h3>
                                <p>Order Queue</p>
                            </div>
                            <i class="bi bi-clock" style="font-size: 50px;"></i>
                        </div>
                        <!-- <a href="<?= site_url('admin/orders/pending') ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            View Pending Orders <i class="bi bi-link-45deg"></i>
                        </a> -->
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner d-flex align-items-center justify-content-between">
                            <div>
                                <h3>&#x20B1;<?= $totalSales ?></h3>
                                <p>Total Sales</p>
                            </div>
                            <i class="bi bi-bar-chart" style="font-size: 50px;"></i>
                        </div>
                        <!-- <a href="<?= base_url('sales') ?>" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            View Sales Performance <i class="bi bi-link-45deg"></i>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    