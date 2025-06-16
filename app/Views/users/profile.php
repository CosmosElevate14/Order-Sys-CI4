<section class="container mt-5">
    <form action="<?= site_url('/profile') ?>" method="post">
    <h2>Personal Information</h2>
        <div class="row mt-2">
            <div class="col mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstname" value="<?= esc($user['first_name']) ?>">
            </div>
    
            <div class="col mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" value="<?= esc($user['last_name']) ?>" >
            </div>

        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" name="contact" value="<?= esc($user['contact_number']) ?>">
            </div>
    
            <div class="col mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" value="<?= esc($user['address']) ?>">
            </div>
        </div>

        <h3 class="mt-4">Account Information</h3>
        <div class="row mt-2">
            <div class="col mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" value="<?= esc($user['email']) ?>">
            </div>
            
            <div class="col mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update Profile</button>
        <a href="<?= site_url('/home') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
    </form>
</section>
