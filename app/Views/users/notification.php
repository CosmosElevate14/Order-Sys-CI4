<section>
    <div class="container pb-5">
        <div class="card pb-0">
            <div class="card-header">
                Notification
            </div>
            <?php foreach ($notifications as $notification): ?>
                <div class="card-body d-flex align-items-center justify-content-between pb-0 mb-0">
                    <figure class="mb-0">
                        <blockquote class="blockquote">
                            <p>  
                            <?php if ($notification['type'] === 'Placed Order') { ?>
                                <i class="bi bi-cart-check text-success me-2"></i>
                            <?php }elseif ($notification['type'] === 'Change Status'){ ?>
                                <i class="bi bi-arrow-repeat text-primary me-2"></i>
                            <?php }else { ?>
                                <i class="bi bi-chat-dots text-warning me-2"></i>
                            <?php } ?>
                            <?= esc($notification['message']) ?>
                        </p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0">
                            <?= esc($notification['type']) ?>
                        </figcaption>
                    </figure>
                    <!-- <a class="btn btn-primary me-4" href="<?= base_url('/orders/view/' . $notification['reference_id']) ?>">View</a> -->
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</section>


</body>
</html>