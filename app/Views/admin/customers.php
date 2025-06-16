
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        Customers Information
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Customer</li>
                        <li class="breadcrumb-item text-primary" aria-current="page">Information</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div style="margin-top:10px;">
                <?php if (!empty($customers)): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Customer ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= esc($customer['id']) ?></td>
                                <td>
                                    <?= esc($customer['first_name'] ?? '') ?>
                                </td>
                                <td>
                                    <?= esc($customer['last_name'] ?? '') ?>
                                </td>
                                <td><?= esc($customer['email']) ?></td>
                                <td><?= esc($customer['address']) ?></td>
                                <td><?= esc($customer['contact_number']) ?></td>
                            </tr>

                            
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <div class="bg-secondary p-2 rounded mx-3">
                        <p class="text-center mb-0 text-white fw-bold">No Customers Data Available</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>