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
            <?php if (strtolower($status) === 'pending'): ?>
                <div class="">
                    <div class="d-flex align-items-center justify-content-between pe-3">
                        <form class="my-4 w-25" action="<?= site_url('admin/orders/Pending') ?>" method="Get">
                            <div class="d-flex align-items-center gap-2">
                                <input type="text" name="searchGcash" id="searchGcash" class="form-control">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            <?php endif; ?>

            <div style="margin-top:10px;">
                <?php if (strtolower($status) === 'confirmed'): ?>
                    <form action="<?= site_url('admin/orders/Confirmed') ?>" method="get" class="row g-2 mb-3 no-print">
                        <div class="col-md-3">
                            <label for="filterDate">Select Date</label>
                            <input type="date" id="filterDate" name="filterDate" class="form-control">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button class="btn btn-primary btn-sm" type="submit" title="Filter">
                                <i class="bi bi-funnel"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
                <?php if (!empty($orders)): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Order Type</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>GCash Transaction ID</th>
                        <th>Desired Time</th>
                        <th>Desired Date</th>
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
                                elseif ($order['payment_status'] == 'Confirmed'):
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
                                <td><?= esc($order['order_type']) ?></td>
                                <td><?= esc($order['quantity']) ?></td>
                                <td>&#x20B1;<?= esc($order['total']) ?></td>
                                <td>
                                    <?= esc($order['transaction_id'] ?? 'N/A') ?>

                                    <?php if (!empty($order['transaction_id'])): ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($order['desired_time']) ?></td>
                                <td><?= esc($order['desired_date']) ?></td>
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
                                        <a href="<?= site_url('admin/order/ready/' . $order['id']) ?>" class="btn btn-primary btn-sm">
                                            <span class="bi bi-box-seam"></span> Product Ready
                                        </a>
                                        <a href="<?= site_url('admin/order/complete/' . $order['id']) ?>" role="button" class="btn btn-success btn-sm <?php
                                            if (strtolower($order['order_status']) != 'ready') {
                                                ?>disabled-link
                                            <?php
                                            }
                                        ?>"
                                        >
                                            <span class="bi bi-check2-circle"></span> Done
                                        </a>
                                    <?php elseif (strtolower($status) === 'declined'): ?>
                                        <a href="<?= site_url('admin/order/unpaid/' . $order['id']) ?>" class="btn btn-warning btn-sm">
                                            <span class="bi bi-wallet"></span> Not Paid
                                        </a>
                                    <?php elseif (strtolower($status) === 'confirmed'): ?>
                                        <a href="<?= site_url('admin/order/pay/' . $order['id']) ?>" class="btn btn-primary btn-sm">
                                            <span class="bi bi-wallet"></span> Paid
                                        </a>
                                        <a href="<?= site_url('admin/order/ready/' . $order['id']) ?>" class="btn btn-success btn-sm">
                                            <span class="bi bi-envelope"></span> Product Ready213
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    // JavaScript: Filter the Confirmed Orders Table
    document.getElementById('filterForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const selectedDate = document.getElementById('filterDate').value;
        if (!selectedDate) return;

        const rows = document.querySelectorAll('#confirmedOrdersTable tbody tr');
        rows.forEach(row => {
            const dateCell = row.querySelector('td:nth-child(2)');
            const rowDate = dateCell.textContent.trim();
            row.style.display = (rowDate === selectedDate) ? '' : 'none';
        });
    });

    // JavaScript: Download PDF of Filtered Table
    function downloadPDF() {
        const selectedDate = document.getElementById('filterDate').value;
        if (!selectedDate) {
            alert("Please select a date before downloading the PDF.");
            return;
        }

        const table = document.getElementById('confirmedOrdersTable');
        const noPrintElements = document.querySelectorAll('.no-print');
        noPrintElements.forEach(el => el.style.display = 'none');

        html2canvas(table).then((canvas) => {
            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');

            const pageWidth = pdf.internal.pageSize.getWidth();
            const imgProps = pdf.getImageProperties(imgData);
            const imgHeight = (imgProps.height * pageWidth) / imgProps.width;

            pdf.setFontSize(12);
            pdf.text(`Confirmed Orders`, 10, 10);
            pdf.text(`Date: ${selectedDate}`, 10, 18);
            pdf.addImage(imgData, 'PNG', 5, 25, pageWidth - 10, imgHeight);

            pdf.save(`confirmed-orders-${selectedDate}.pdf`);
        }).finally(() => {
            noPrintElements.forEach(el => el.style.display = '');
        });
    }
</script>

</body>
</html>
