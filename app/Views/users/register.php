<section class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100dvh;">
    <img class="img-fluid" style="width: 150px;" src="<?= base_url('/upload/logo2.png') ?>" alt="Apollo XII Logo">
    <h3>Apollo XIII Registration</h3>
    <div class="container w-50 mt-4 p-2">
        <form action="<?= site_url('/register') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col form-floating mb-3" >
                    <input type="text" name="firstname" class="form-control" id="floatingInput" placeholder="Mike">
                    <label class="ms-2" for="floatingInput">First Name</label>
                </div>
                <div class="col form-floating mb-3" >
                    <input type="text" name="lastname" class="form-control" id="floatingInput" placeholder="Enriquez" >
                    <label class="ms-2" for="floatingInput">Last Name</label>
                </div>
            </div>
            <div class="row">
                <div class="col form-floating mb-3" >
                    <input type="text" name="address" class="form-control" id="floatingInput" placeholder="Block 29 Side Street" >
                    <label class="ms-2" for="floatingInput">Address</label>
                </div>
                <div class="col form-floating mb-3" >
                    <input type="text" name="contact" class="form-control" id="floatingInput" placeholder="0912398123" >
                    <label class="ms-2" for="floatingInput">Contact Number</label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <p>Already have an account? Login <a href="<?= site_url('/login') ?>">here</a></p>
            <button type="submit" class="btn btn btn-primary btn-block w-100">Register</button>
            <a role="button" href="<?= site_url('/home') ?>" class="btn btn btn-secondary mt-3 btn-block w-100">Back to Home</a>
        </form>
        
    </div>
</section>