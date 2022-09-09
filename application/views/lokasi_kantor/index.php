<div class="container pt-3">
    <div class="card shadow mx-auto col-lg-8 col-md-9 col-sm-12">
        <div class="card-body text-center">
            <h5 class="card-title fw-bold">Tentukan Lokasi Kantor</h5>
            <?php if ($this->session->flashdata('flash')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Lokasi Kantor <strong>Berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <form action="" method="POST">
                <input type="hidden" class="form-control" id="lat" name="lat">
                <input type="hidden" class="form-control" id="lon" name="lon">
                <div class="mb-3">
                    <label for="jarak" class="form-label">Radius Dari Kantor (Satuan Meter)</label>
                    <input type="text" class="form-control" id="jarak" name="jarak">
                    <div class="form-text text-danger"><?= form_error('jarak'); ?></div>
                </div>
                <button type="submit" class="btn btn-primary">Tentukan</button>
            </form>
        </div>
    </div>
</div>