<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('styles/style.css') ?>">
    <title>Admin Login</title>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center" id="login-container">
        <form class="d-flex flex-column gap-3" action="<?= site_url('login/authenticate') ?>" method="POST" id="form-container">
            <div class="text-center">
                <img src="<?= base_url('upload/logo.png') ?>" alt="Apollo XIII Store Logo" class="img-fluid mb-3" style="max-width: 300px;">
                <h3>Admin Login</h3>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control rounded" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control rounded" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
</body>
</html>
