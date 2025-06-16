
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">

                            <?php if (strtolower($status) === 'pending'): ?>
                                <span class="text-primary">Customers Order</span>
                            <?php elseif (strtolower($status) === 'confirmed'): ?>
                                <span class="text-success">Confirmed Orders</span>
                            <?php elseif (strtolower($status) === 'declined'): ?>
                                <span class="text-danger">Declined Orders</span>
                            <?php endif; ?>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Orders</li>
                        <li class="breadcrumb-item text-primary" aria-current="page"><?= esc($status) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div style="margin-top:10px;">
                <?php if (!empty($orders)): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Order Type</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>
                            
                            <?php if (strtolower($status) === 'pending'): ?>
                                Action
                            <?php else: ?>
                                Status
                            <?php endif; ?>

                        </th>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= esc($order['id']) ?> 

                                <?php 
                                if ($order['payment_status'] == 'Pending'):
                                ?>
                                <span class="badge text-bg-warning"><?= $order['payment_status'] ?></span>
                                <?php 
                                elseif ($order['payment_status'] == 'Paid'):
                                ?>
                                    <span class="badge text-bg-success"><?= $order['payment_status'] ?></span>
                                <?php 
                                elseif ($order['payment_status'] == 'Not Paid'):
                                ?>
                                    <span class="badge text-bg-danger"><?= $order['payment_status'] ?></span>
                                <?php 
                                endif;
                                ?>
                            </td>
                                <td>
                                    <?= esc($order['customer']['first_name'] ?? '') ?>
                                    <?= esc($order['customer']['last_name'] ?? '') ?>
                                </td>
                                <td><?= esc($order['order_type']) . ' ' . esc($order['payment_status']) ?></td>
                                <td><?= esc($order['quantity']) ?></td>
                                <td>&#x20B1;<?= esc($order['total']) ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewOrderModal<?= $order['id'] ?>">
                                        <span class="bi bi-eye"></span> View
                                    </button>
                                    
                                    <?php if (strtolower($status) === 'pending'): ?>
                                        <a href="<?= site_url('admin/order/confirm/' . $order['id']) ?>" class="btn btn-success btn-sm">
                                            <span class="bi bi-check"></span> Confirm
                                        </a>
                                        <a href="<?= site_url('admin/order/decline/' . $order['id']) ?>" class="btn btn-danger btn-sm">
                                            <span class="bi bi-x"></span> Decline
                                        </a>
                                        
                                    <?php elseif (strtolower($status) === 'confirmed'): ?>
                                        <a href="<?= site_url('admin/order/pay/' . $order['id']) ?>" class="btn btn-primary btn-sm">
                                            <span class="bi bi-wallet"></span> Paid
                                        </a>
                                        <a href="<?= site_url('admin/order/ready/' . $order['id']) ?>" class="btn btn-success btn-sm">
                                            <span class="bi bi-envelope"></span> Product Ready
                                        </a>
                                    <?php elseif (strtolower($status) === 'declined'): ?>

                                        <a href="<?= site_url('admin/order/unpaid/' . $order['id']) ?>" class="btn btn-warning btn-sm">
                                            <span class="bi bi-wallet"></span> Not Paid
                                        </a>
                                    <?php endif; ?>
                                    <!-- View Button -->
                                    
                                </td>
                            </tr>

                            
                        <?php endforeach; ?>
                    </tbody>
                </table>
                            <?php foreach ($orders as $order): ?>
                                <div class="modal fade" id="viewOrderModal<?= $order['id'] ?>" tabindex="-1" aria-labelledby="viewOrderModalLabel<?= $order['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewOrderModalLabel<?= $order['id'] ?>">Order #<?= esc($order['id']) ?> Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Customer:</strong> <?= esc($order['customer']['first_name'] ?? '') ?> <?= esc($order['customer']['last_name'] ?? '') ?></p>
                                                <p><strong>Order Type:</strong> <?= esc($order['order_type']) ?></p>
                                                <?php 
                                                if ($order['customer']['address']):
                                                ?>
                                                    <p><strong>Address:</strong> <?= esc($order['customer']['address'] ?? '') ?></p>
                                                <?php endif; ?>
                                                <p><strong>Total:</strong> <?= esc($order['total']) ?></p>
                                                <hr>
                                                <h6>Products</h6>
                                                <?php if (!empty($order['details'])): ?>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Product Image</th>
                                                                <th>Product Name</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($order['details'] as $detail): ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php if (!empty($detail['product_image'])): ?>
                                                                            <img src="<?= base_url($detail['product_image']) ?>" height="40" width="50">
                                                                        <?php else: ?>
                                                                            <span class="text-muted">No image</span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><?= esc($detail['product_name'] ?? 'N/A') ?></td>
                                                                    <td><?= esc($detail['quantity']) ?></td>
                                                                    <td><?= esc($detail['price']) ?></td>
                                                                    <td><?= esc($detail['subtotal']) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php else: ?>
                                                    <p>No product details available.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?> 
                <?php else: ?>
                    <div class="bg-secondary p-2 rounded mx-3">
                        <p class="text-center mb-0 text-white fw-bold">No Orders Available</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>