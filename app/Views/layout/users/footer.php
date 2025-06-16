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