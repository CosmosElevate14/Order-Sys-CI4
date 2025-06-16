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
                    <!-- <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div> -->

                    <div class="mb-3">
                        <label for="order_type" class="form-label">Order Type</label>
                        <select class="form-select" name="order_type" id="order_type" required>
                            <option value="">Select Type</option>
                            <option value="pickup">Pick up</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>

                    <div class="mb-3 d-none" id="addressField">
                        <label for="address" class="form-label">Delivery Address</label>
                        <textarea class="form-control" name="address" id="address" rows="2"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Confirm Order</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
function toggleAddressField() {
  const orderType = document.getElementById("order_type").value;
  const addressField = document.getElementById("addressField");

  if (orderType === "delivery") {
    addressField.classList.remove("d-none");
    document.getElementById("address").setAttribute("required", "required");
  } else {
    addressField.classList.add("d-none");
    document.getElementById("address").removeAttribute("required");
  }
}
</script>
