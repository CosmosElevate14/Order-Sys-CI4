<section >
    <div class="container pb-5" >
        <div class="card">
            <h5 class="card-header text-center">Shopping Cart</h5>
            <hr>
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $item): ?>
                        <form action="<?= site_url('/cart/update') ?>" method="post" class="card-body d-flex align-items-center justify-content-between mb-0">
                            <input type="hidden" name="item_id" value="<?= esc($item['id']) ?>">

                            <div class="flex-grow-1 me-3">
                                <h5 class="card-title mb-1"><?= esc($item['item_name']) ?></h5>
                                <div class="d-flex align-items-center gap-2">
                                    <label for="qty<?= esc($item['id']) ?>" class="form-label mb-0">Qty:</label>
                                    <input type="number" class="form-control form-control-sm" id="qty<?= esc($item['id']) ?>" name="quantity" value="<?= esc($item['quantity']) ?>" min="1" style="width: 70px;">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                                </div>
                            </div>

                            <div class="text-end me-3">
                                <p class="fs-6 fw-bold mb-0">&#x20B1;<?= esc($item['total']) ?></p>
                            </div>

                            <a href="<?= site_url('/cart/remove/' . esc($item['id'])) ?>" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i> Remove
                            </a>
                        </form>
                    <?php endforeach; ?>
                    
                    <div class="card-footer d-flex align-items-center justify-content-between mb-0">
                        <p class="fs-5 fw-bold">Grand Total</p>
                        <p class="me-5 fs-5 fw-bold">&#x20B1;<?= esc($grandTotal) ?></p>
                    </div>
                <?php else: ?>
                    <div class="bg-secondary p-2 rounded mx-3">
                        <p class="text-center mb-0 text-white fw-bold">No Items in the Cart</p>
                    </div>
                <?php endif; ?>

        </div>

        <div class="d-flex justify-content-end container" >
            <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                Proceed to Checkout
            </button>
        </div>
    </div>
    
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?= site_url('/cart/checkout') ?>" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Order Type -->
                        <div class="mb-3">
                            <label for="order_type" class="form-label">Order Type</label>
                            <select class="form-select" name="order_type" id="order_type" required onchange="toggleAddressField()">
                                <option value="">Select Type</option>
                                <option value="pickup">Pick up</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>

                        <!-- Desired Date -->
                        <div class="mb-3">
                            <label for="order_date" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" name="desired_date" id="order_date" min="<?= date('Y-m-d', strtotime('+2 days')) ?>" required>
                        </div>

                        <!-- Desired Time -->
                        <div class="mb-3">
                            <label for="desired_time" class="form-label">Preferred Time (9:00 AM – 5:00 PM)</label>
                            <select class="form-select" name="desired_time" id="desired_time" required>
                                <option value="">Select Time</option>
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="pickup_info">
                            <p class="fw-bold">Pick-up Location:</p>
                            <p class="text-muted">Apollo XIII Pastry Shop, Main Street, City</p>
                            <div class="alert alert-info">Pick-up orders are available between 9AM to 5PM only.</div>
                        </div>

                        <!-- Pick-up Location -->
                        <div class="mb-3 d-none" id="pickup_info">
                            <p class="fw-bold">Pick-up Location:</p>
                            <p class="text-muted">Apollo XIII Pastry Shop, Main Street, City</p>
                        </div>

                        <!-- GCash Info -->
                        <div class="mb-3">
                            <h6 class="fw-bold">GCash Payment</h6>
                            <p>Name: <strong>Apollo XIII</strong></p>
                            <p>Number: <strong>09XXXXXXXXX</strong></p>
                            <p>Please transfer the Grand Total (₱<?= esc($grandTotal ?? 'XXX') ?>) to our GCash account above. After transferring, input your Transaction ID below.</p>
                            <input type="text" class="form-control" name="transaction_id" placeholder="Transaction ID" required>
                            <p class="text-muted mt-2">Your order will only be processed once your payment is verified.</p>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">Place Order</button>
                    </div>
                </form>
            </div>
    </div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const orderTypeSelect = document.getElementById("order_type");
  const addressField = document.getElementById("addressField");
  const pickupInfo = document.getElementById("pickup_info");
  const addressInput = document.getElementById("address");
  const desiredTime = document.getElementById("desired_time");
  const startHour = 9;
  const endHour = 17; // 5 PM in 24-hour format
  
  for (let hour = startHour; hour <= endHour; hour++) {
    const ampm = hour >= 12 ? "PM" : "AM";
    let displayHour = hour > 12 ? hour - 12 : hour;
    if (displayHour === 0) displayHour = 12;

    const timeStr = `${String(displayHour).padStart(2, '0')}:00 ${ampm}`;

    const option = document.createElement("option");
    option.value = timeStr;
    option.textContent = timeStr;

    desiredTime.appendChild(option);
  }

  function toggleAddressField() {
    const orderType = orderTypeSelect.value;

    if (orderType === "delivery") {
      addressField.classList.remove("d-none");
      pickupInfo.classList.add("d-none");
      addressInput.setAttribute("required", "required");
    } else if (orderType === "pickup") {
      pickupInfo.classList.remove("d-none");
      addressField.classList.add("d-none");
      addressInput.removeAttribute("required");
    } else {
      addressField.classList.add("d-none");
      pickupInfo.classList.add("d-none");
      addressInput.removeAttribute("required");
    }
  }

  orderTypeSelect.addEventListener("change", toggleAddressField);
  toggleAddressField(); // Run once on page load
});
</script>


