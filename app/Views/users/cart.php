<section style="margin-top: 100px;">
    <div class="container pb-5">
        <div class="card border-0 rounded-4 cart-hover">
            <h5 class="card-header text-center bg-white fw-bold fs-4 py-3 border-bottom">🛒 Shopping Cart</h5>

            <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                    <form action="<?= site_url('/cart/update') ?>" method="post" class="border-bottom px-4 py-3 d-flex align-items-center justify-content-between flex-wrap">
                        <input type="hidden" name="item_id" value="<?= esc($item['id']) ?>">

                        <!-- Item Info -->
                        <div class="flex-grow-1 me-3">
                            <h6 class="mb-1 fw-semibold"><?= esc($item['item_name']) ?></h6>
                            <div class="d-flex align-items-center gap-2">
                                <label for="qty<?= esc($item['id']) ?>" class="form-label mb-0">Qty:</label>
                                <input type="number" class="form-control form-control-sm" id="qty<?= esc($item['id']) ?>" name="quantity" value="<?= esc($item['quantity']) ?>" min="1" style="width: 70px;">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="text-end me-4">
                            <p class="fs-6 fw-bold mb-1 text-success">₱<?= esc($item['total']) ?></p>
                        </div>

                        <!-- Remove -->
                        <a href="<?= site_url('/cart/remove/' . esc($item['id'])) ?>" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i> Remove
                        </a>
                    </form>
                <?php endforeach; ?>

                <!-- Grand Total -->
                <div class="card-footer d-flex justify-content-between align-items-center bg-light rounded-bottom-4 py-3 px-4">
                    <p class="fs-5 fw-bold mb-0 text-dark">Grand Total</p>
                    <p class="fs-5 fw-bold mb-0 text-primary">₱<?= esc($grandTotal) ?></p>
                </div>
            <?php else: ?>
                <div class="bg-light p-4 rounded text-center">
                    <p class="text-muted fw-semibold mb-0">Your cart is currently empty.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($cartItems)): ?>
        <!-- Proceed to Checkout -->
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                <i class="bi bi-credit-card me-1"></i> Proceed to Checkout
            </button>
        </div>
        <?php endif; ?>
    </div>

    <!-- 🧾 Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= site_url('/cart/checkout') ?>" method="post" class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title fw-bold" id="checkoutModalLabel">Checkout Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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

                    <!-- Pickup Info -->
                    <div class="mb-3 d-none" id="pickup_info">
                        <div class="alert alert-info mb-2">
                            <strong>Pick-up Location:</strong> Apollo XIII Pastry Shop, 906 Jose Riel Street Sawang Carigara Leyte<br>
                            <small class="text-muted">Available from 9:00 AM to 5:00 PM</small>
                        </div>
                    </div>

                    <!-- GCash -->
                    <div class="mb-3">
                        <h6 class="fw-bold">GCash Payment</h6>
                        <ul class="list-unstyled mb-2">
                            <li><strong>Name:</strong> Apollo XIII</li>
                            <li><strong>Number:</strong> 09513698085</li>
                        </ul>
                        <div class="alert alert-warning small">
                            Please send a payment of <strong>₱<?= esc($grandTotal ?? 'XXX') ?></strong> to the GCash number provided Above, then enter your GCash Transaction ID in the field below.
                        </div>
                        <input type="text" class="form-control" name="transaction_id" placeholder="GCash Transaction ID" required>
                        <small class="text-muted d-block mt-2">Your order will only be processed after payment verification.</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100 fw-semibold rounded-pill">
                        <i class="bi bi-check-circle me-1"></i> Place Order
                    </button>
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


