<!-- Main Wrapper -->
<div class="my-container active-cont position-relative">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light bg-dark px-5 sticky-top">
        <a class="btn border-0" id="menu-btn"><i class="fas fa-bars"></i></a>
    </nav>
    <div class="container mt-3">
        <?= $this->session->flashdata('flash'); ?>
    </div>
    <!--End Top Nav -->
    <h3 class="text-dark p-3 h3 text-center">Scan Qrcode Anda</h3>
    <div class="px-3 overflow-hidden">
        <div class="card mb-3 mx-auto h-auto col-lg-7 col-md-9 shadow">
            <div class="card-body">
                <input type="hidden" id="nip" value="<?= $account['nip']; ?>">
                <input type="hidden" id="nama" value="<?= $account['nama']; ?>">
                <input type="hidden" id="lat">
                <input type="hidden" id="lon">
                <div class="w3-container" style="text-align: center; margin: 0 auto;">
                    <div class="w3-card-4" style="width: 100%; padding-top: 20px;" id="qr-pegawai">
                        <center>
                            <div id="qrcode" style="width: 100%;"></div>
                        </center>
                        <div class="w3-container w3-center" style="margin-top: 20px;">
                            <p><b>NIP</b> : <span id="_nip"></span> <br>
                                <b>NAMA</b> : <span id="_nama"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>