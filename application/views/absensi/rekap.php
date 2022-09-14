<div class="pt-4">
    <h5 class="fs-4 fw-bold text-center">Rekap Absensi</h5>
    <h5 class="fw-bold text-center"><?= bulan(date("m")) . " " . date('Y'); ?></h5>
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
                        <?php if ($rekap) {
                            echo '<td class="text-bg-success text-center"> <i class="fa-solid fa-check"></i><br>' . date('H:i', strtotime($rekap[0]['time'])) . ' </td>';
                        } else {
                            echo '<td class="text-bg-danger text-center"> <i class="fa-solid fa-xmark"></i> </td>';
                        }
                        ?>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>