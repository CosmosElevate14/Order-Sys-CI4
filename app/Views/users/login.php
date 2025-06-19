<section class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100dvh;">
    <img class="img-fluid mb-3" style="width: 150px;" src="<?= base_url('/upload/logo2.png') ?>" alt="Apollo XII Logo">
    <h3 class="fw-bold text-primary">Apollo XIII Pastry Shop Login</h3>

    <div class="container mt-4 p-4 shadow-lg rounded bg-white" style="max-width: 500px;">
        <form action="<?= site_url('/login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="floatingInput" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="floatingPassword" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                </div>
            </div>

            <p class="text-center mt-3 mb-1">
                No account? <a href="<?= site_url('/register') ?>" class="fw-semibold text-decoration-none">Register here</a>
            </p>

            <button type="submit" class="btn btn-primary w-100 fw-bold">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>

            <a role="button" href="<?= site_url('/home') ?>" class="btn btn-secondary mt-2 w-100 fw-bold">
                <i class="bi bi-house-fill me-2"></i>Back to Home
            </a>
        </form>
    </div>
</section>
