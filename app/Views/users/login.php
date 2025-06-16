<section class="container d-flex flex-column align-items-center justify-content-center w-50" style="min-height: 100dvh;">
    <img class="img-fluid" style="width: 150px;" src="<?= base_url('/upload/logo2.png') ?>" alt="Apollo XII Logo">
    <h3>Apollo XIII Login</h3>
    <div class="container w-50 mt-4 p-2">
        <form action="<?= site_url('/login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <p>No account? Register <a href="<?= site_url('/register') ?>">here</a></p>

            <button type="submit" class="btn btn btn-primary btn-block w-100">Login</button>
            <a role="button" href="<?= site_url('/home') ?>" class="btn btn btn-secondary mt-2 btn-block w-100">Back to Home</a>
        </form>
        
    </div>
</section>