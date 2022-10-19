<div class="pt-4">
    <?= $this->session->flashdata('flash'); ?>
    <h5 class="fs-4 fw-bold text-center">Rekap Absensi</h5>
    <h5 class="fw-bold text-center"><?= bulan(date("m")) . " " . date('Y'); ?></h5>
    <form action="<?= base_url('absensi/detailrekap'); ?>" method="post" target="_blank">
        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-12 mb-3">
                <select class="form-select" name="bulan">
                    <option value="0" selected>Bulan Ini</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-12 mb-3">
                <input type="number" class="form-control" placeholder="Tahun" name="tahun">
            </div>
            <div class="col-md-1 col-sm-12 text-center">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-download"></i></button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered shadow mt-3 align-middle">
            <thead>
                <tr>
                    <th class="text-center" scope="col">NIP</th>
                    <?php for ($i = 1; $i < $jum_tanggal + 1; $i++) { ?>
                        <th class="text-center" scope="col"><?= $i; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pegawai as $p) : ?>
                    <tr>
                        <td class="text-center"><?= $p['nip'] . '<br>' . $p['nama']; ?></td>
                        <?php for ($i = 1; $i < $jum_tanggal + 1; $i++) { ?>
                            <?php $rekap = $this->Absensi_model->jum_absen($p['nip'], $i); ?>
                            <?php if ($rekap) { ?>
                                <td class="text-bg-success text-center">
                                    <form action="<?= base_url('absensi/del_adm_absen'); ?>" method="post">
                                        <input type="hidden" value="<?= $rekap[0]['id']; ?>" name="id">
                                        <button type="submit" class="p-0 m-0 border-0 bg-transparent text-white"><i class="fa-solid fa-check"></i><br></button>
                                    </form>
                                    <span style="font-size: 0.7rem;">
                                        <?= date('H:i', strtotime($rekap[0]['time'])) ?>
                                    </span>
                                </td>
                            <?php } else { ?>
                                <td class="text-bg-danger text-center">
                                    <form action="<?= base_url('absensi/adm_absen'); ?>" method="post">
                                        <input type="hidden" value="<?= $p['nip']; ?>" name="nip">
                                        <input type="hidden" value="<?= date('Y-m') . '-' . $i . ' ' . '00:00:00'; ?>" name="time">
                                        <button type="submit" class="p-0 m-0 border-0 bg-transparent text-white"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </td>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>