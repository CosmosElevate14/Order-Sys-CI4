<!-- START OF COMPACT VERTICAL FOOTER -->
<!-- START OF IMPROVED FOOTER -->
<footer class="bg-dark text-white pt-4 pb-3 mt-5">
  <div class="container">
    <div class="row text-center text-md-start">
      <!-- Brand and Contact Info -->
      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Apollo XIII Pastry Shop</h5>
        <p class="mb-1 small">906 Jose Riel Street Sawang Carigara Leyte</p>
        <p class="mb-1 small">Phone: 09513698085</p>
        <p class="mb-0 small">Email: apolloxiii@gmail.com</p>
      </div>

`
      <!-- Social Media -->
      <div class="col-md-4 mb-3 text-md-end">
        <h6 class="fw-semibold">Follow Us</h6>
        <a href="https://www.facebook.com/profile.php?id=61577788491769" class="text-white fs-5 me-2"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-white fs-5 me-2"><i class="bi bi-instagram"></i></a>
      </div>
    </div>

    <hr class="border-secondary my-2">

    <div class="text-center small">
      <p class="mb-0">&copy; <?= date('Y') ?> Apollo XIII. All rights reserved.</p>
    </div>
  </div>
</footer>
<!-- END OF IMPROVED FOOTER -->



<!-- SWEETALERT FLASH MESSAGES -->
<script>
    document.addEventListener('DOMContentLoaded', function() { 
        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= session()->getFlashdata('error'); ?>'
            });
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= session()->getFlashdata('success'); ?>'
            });
        <?php endif; ?>
    });
</script>

</body>
</html>
