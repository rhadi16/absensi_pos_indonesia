<div class="my-container active-cont position-relative">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light bg-dark px-5 sticky-top">
        <a class="btn border-0" id="menu-btn"><i class="fas fa-bars"></i></a>
    </nav>
    <!--End Top Nav -->
    <div class="container pt-3">
        <?= $this->session->flashdata('flash'); ?>
        <div class="card shadow mx-auto col-lg-8 col-md-9 col-sm-12">
            <div class="card-body text-center">
                <h5 class="card-title">Selamat Datang</h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $account['email']; ?></h6>
                <img src="<?= base_url('assets/img-profile/not.jpg'); ?>" class="img-thumbnail w-50 rounded-5" alt="...">
            </div>
        </div>
    </div>
</div>