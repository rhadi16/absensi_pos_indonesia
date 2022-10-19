<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $judul; ?></title>
    <!-- CSS Bootstrap 5 -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/bootstrap5/css/bootstrap.min.css'); ?>"> -->
    <!-- Icon -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css'); ?>"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> -->
    <!-- My CSS -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/admin_style.css'); ?>"> -->
    <style>
        body {
            padding-left: 10px;
            padding-right: 10px;
            font-family: Arial, sans-serif;
        }

        .fs-4 {
            font-size: 2rem;
        }

        .fs-20 {
            font-size: 20px;
        }

        .p-0 {
            padding: 0;
        }

        .m-0 {
            margin: 0;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        table tr td,
        table tr th {
            padding: 5px 2px;
            border: 1px solid black;
        }

        .text-bg-success {
            background-color: #388e3c;
            color: #fff;
        }

        .text-bg-danger {
            background-color: #d32f2f;
            color: #fff;
        }
    </style>
</head>

<body>
    <h5 class="fs-4 fw-bold text-center p-0 m-0 mb-10">Rekap Absensi</h5>
    <h5 class="fw-bold text-center m-0 mb-10 fs-20"><?= bulan($bulan) . " " . $tahun; ?></h5>
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
                        <?php $rekap = $this->Absensi_model->detail_jum_absen($i, $bulan, $tahun, $p['nip']); ?>
                        <?php if ($rekap) {
                            echo '<td class="text-bg-success text-center"><span style="font-size: 0.7rem;">' . date('H:i', strtotime($rekap[0]['time'])) . '</span> </td>';
                        } else {
                            echo '<td class="text-bg-danger text-center">x</td>';
                        }
                        ?>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>