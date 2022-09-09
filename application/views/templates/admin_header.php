<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $judul; ?></title>
    <!-- CSS Bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap5/css/bootstrap.min.css'); ?>">
    <!-- Icon -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- Scanner -->
    <link rel="manifest" href="https://qrcodescan.in/manifest.json">
    <link rel="stylesheet" href="https://qrcodescan.in/bundle.css">
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin_style.css'); ?>">
</head>

<body id="body-pd">
    <header class="header mb-3 shadow" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="header_img">
            <img src="<?= base_url('assets/img-profile/Pos-Indonesia.png') ?>" class="img-fluid" alt="">
        </div>
    </header>
    <div class="l-navbar pe-0" id="nav-bar">
        <nav class="nav">
            <div class="w-75 mx-auto">
                <img src="<?= base_url('assets/img-profile/Pos-Indonesia.png') ?>" class="img-fluid col-12" alt="">
            </div>
            <!-- <a href="#" class="nav_logo mb-2 row">
            </a> -->
            <div>
                <div class="nav_list">
                    <a href="<?= base_url('admin') ?>" class="nav_link <?php if ($judul == "Home") {
                                                                            echo "active";
                                                                        } ?>">
                        <i class='fa-solid fa-house nav_icon me-2'></i>
                        <span class="nav_name">Home</span>
                    </a>
                    <a href="<?= base_url('pegawai') ?>" class="nav_link <?php if ($judul == "Pegawai") {
                                                                                echo "active";
                                                                            } ?>">
                        <i class="fa-solid fa-users nav_icon me-2"></i>
                        <span class="nav_name">Pegawai</span>
                    </a>
                    <a href="<?= base_url('lokasi_kantor') ?>" class="nav_link <?php if ($judul == "Lokasi Kantor") {
                                                                                    echo "active";
                                                                                } ?>">
                        <i class="fa-solid fa-map-location-dot nav_icon me-2"></i>
                        <span class="nav_name">Lokasi Kantor</span>
                    </a>
                    <a href="<?= base_url('absensi') ?>" class="nav_link <?php if ($judul == "Absensi") {
                                                                                echo "active";
                                                                            } ?>">
                        <i class="fa-solid fa-qrcode nav_icon me-3"></i>
                        <span class="nav_name">Absensi</span>
                    </a>
                    <a href="<?= base_url('absensi/rekap') ?>" class="nav_link <?php if ($judul == "Rekap Absensi") {
                                                                                    echo "active";
                                                                                } ?>">
                        <i class="fa-solid fa-clipboard-check nav_icon me-3"></i>
                        <span class="nav_name">Rekap Absensi</span>
                    </a>
                </div>
            </div> <a class="nav_link" id="logout" onclick="logout('<?= base_url('auth/logout'); ?>')"><i class='bx bx-log-out nav_icon me-2'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>