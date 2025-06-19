<section class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100dvh;">
    <img class="img-fluid mb-3" style="width: 150px;" src="<?= base_url('/upload/logo2.png') ?>" alt="Apollo XII Logo">
    <h3 class="fw-bold text-primary">Apollo XIII Pastry Shop Registration</h3>

    <div class="container p-4 mt-4 shadow-lg rounded bg-white" style="max-width: 600px;">
        <form action="<?= site_url('/register') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Juan" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enriquez" required>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Block 29 Side Street" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="contact" class="form-label">Contact Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input type="text" name="contact" id="contact" class="form-control" placeholder="09123456789" required>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com" required>
                </div>
            </div>

            <div class="mt-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="•••••••" required>
                </div>
            </div>

            <p class="text-center mt-3 mb-0">
                Already have an account? <a href="<?= site_url('/login') ?>" class="text-decoration-none fw-semibold">Login here</a>
            </p>

            <button type="submit" class="btn btn-primary w-100 mt-3 fw-bold">
                <i class="bi bi-person-plus-fill me-2"></i>Register
            </button>

            <a href="<?= site_url('/home') ?>" class="btn btn-secondary w-100 mt-2 fw-bold">
                <i class="bi bi-house-fill me-2"></i>Back to Home
            </a>
        </form>
    </div>
</section>
