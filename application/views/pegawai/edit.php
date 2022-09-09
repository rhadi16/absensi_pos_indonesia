<div class="container pt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card shadow">
                <h5 class="card-header fw-bold text-center">Form Edit Karyawan</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="nip_lama" value="<?= $pegawai['nip']; ?>">
                        <input type="hidden" name="password_lama" value="<?= $pegawai['password']; ?>">
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="<?= $pegawai['nip']; ?>">
                            <div class="form-text text-danger"><?= form_error('nip'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $pegawai['nama']; ?>">
                            <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="jkl" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jkl" name="jkl">
                                <option value="0">Pilih Jenis Kelamin</option>
                                <option value="L" <?php if ($pegawai['jkl'] == "L") {
                                                        echo "selected";
                                                    } ?>>Laki-laki</option>
                                <option value="P" <?php if ($pegawai['jkl'] == "P") {
                                                        echo "selected";
                                                    } ?>>Perempuan</option>
                            </select>
                            <div class="form-text text-danger"><?= form_error('jkl'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $pegawai['email']; ?>">
                            <div class="form-text text-danger"><?= form_error('email'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text text-danger"><?= form_error('password'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Ulangi Password</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                            <div class="form-text text-danger"><?= form_error('password2'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Status</label>
                            <select class="form-select" id="role_id" name="role_id">
                                <option value="0">Pilih Status</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>" <?php if ($pegawai['role_id'] == $r['id']) {
                                                                            echo "selected";
                                                                        } ?>><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text text-danger"><?= form_error('role_id'); ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                        <a href="<?= base_url('pegawai'); ?>" class="btn btn-danger mx-2 float-end">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>