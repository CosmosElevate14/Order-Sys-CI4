<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('styles/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Admin Login</title>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card p-4" id="login-card">
            <form action="<?= site_url('login/authenticate') ?>" method="POST">
                <div class="text-center mb-3">
                    <img src="<?= base_url('upload/logo.png') ?>" alt="Apollo XIII Store Logo" class="img-fluid" style="max-width: 200px;">
                    <h4 class="mt-3 mb-0 fw-semibold">Admin Login</h4>
                    <p class="text-muted small">Access your dashboard securely</p>
                </div>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
