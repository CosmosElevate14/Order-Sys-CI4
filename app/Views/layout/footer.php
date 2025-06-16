</div>

    <footer class="text-center py-3 bg-light mt-auto">

    <small>&copy; <?= date('Y') ?> Apollo XIII. All rights reserved.</small>
    
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('adminlte/js/adminlte.js') ?>"></script>
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