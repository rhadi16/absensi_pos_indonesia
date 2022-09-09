<div class="container pt-5">
    <?= $this->session->flashdata('flash'); ?>
    <div class="row align-items-center justify-content-between">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <h5 class="fw-bold fs-4">Data Karyawan</h5>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
            <a href="<?= base_url('pegawai/tambah'); ?>" class="btn btn-success float-end w-100">Tambah Data</a>
        </div>
    </div>
    <table id="pegawai" class="table table-striped align-middle" style="width:100%">
        <thead>
            <tr>
                <th>Nip</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pegawai as $p) : ?>
                <tr>
                    <td><?= $p['nip']; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['email']; ?></td>
                    <td><?= $retVal = ($p['jkl'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                    <td><?= $p['role']; ?></td>
                    <td>
                        <a href="<?= base_url('pegawai/edit/') . $p['nip']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" onclick="hapusPegawai('<?= $p['nama']; ?>', '<?= base_url('pegawai/hapus/') . $p['nip']; ?>')" class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nip</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Option</th>
            </tr>
        </tfoot>
    </table>
</div>