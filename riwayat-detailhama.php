<?php
$title = "Detail Riwayat Hama - Certainty Factor (CF)";
require 'layouts/header.php';
require 'layouts/navbar.php';
require 'layouts/sidebar.php';
require 'functions.php';

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Riwayat Hama</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Detail Riwayat Hama</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php
            if ($_GET["id"]) {
                $arcolor = array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700');
                date_default_timezone_set("Asia/Jakarta");
                $inptanggal = date('Y-m-d H:i:s');

                $arbobot = array('1', '0.8', '0.6', '0.4', '0.2', '0');
                $argejala = array();

                for ($i = 0; $i < count($_POST['kondisi']); $i++) {
                    $arkondisi = explode("_", $_POST['kondisi'][$i]);
                    if (strlen($_POST['kondisi'][$i]) > 1) {
                        $argejala += array($arkondisi[0] => $arkondisi[1]);
                    }
                }

                $sqlkondisi = mysqli_query($conn, "SELECT * FROM kondisi_hama order by id+0");
                while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
                    $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
                }

                $sqlpkt = mysqli_query($conn, "SELECT * FROM hama order by kode_hama+0");
                while ($rpkt = mysqli_fetch_array($sqlpkt)) {
                    $arpkt[$rpkt['kode_hama']] = $rpkt['nama_hama'];
                    $ardpkt[$rpkt['kode_hama']] = $rpkt['det_hama'];
                    $arspkt[$rpkt['kode_hama']] = $rpkt['srn_hama'];
                    $argpkt[$rpkt['kode_hama']] = $rpkt['gambar'];
                }

                $sqlhasil = mysqli_query($conn, "SELECT * FROM hasil_hama where id_hasil=" . $_GET['id']);
                while ($rhasil = mysqli_fetch_array($sqlhasil)) {
                    $arpenyakit = unserialize($rhasil['hama']);
                    $argejala = unserialize($rhasil['ghama']);
                }

                $np1 = 0;
                foreach ($arpenyakit as $key1 => $value1) {
                    $np1++;
                    $idpkt1[$np1] = $key1;
                    $vlpkt1[$np1] = $value1;
                }
            ?>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Gejala yang dialami (Keluhan)</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <?php
                            $ig = 0;
                            foreach ($argejala as $key => $value) {
                                $kondisi = $value;
                                $ig++;
                                $gejala = $key;
                                $sql4 = mysqli_query($conn, "SELECT * FROM gejala_hama where kode_ghama = '$key'");
                                $r4 = mysqli_fetch_array($sql4);
                            ?>
                                <tr>
                                    <td><?= $ig; ?></td>
                                    <td>G<?= str_pad($r4[0], 3, '0', STR_PAD_LEFT); ?></td>
                                    <td><?= $r4[1]; ?></td>
                                    <td><span class="kondisipilih" style="color:'<?= $arcolor[$kondisi]; ?>'"><?= $arkondisitext[$kondisi]; ?></span></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <?php
                $np = 0;
                foreach ($arpenyakit as $key => $value) {
                    $np++;
                    $idpkt[$np] = $key;
                    $nmpkt[$np] = $arpkt[$key];
                    $vlpkt[$np] = $value;
                }
                if ($argpkt[$idpkt[1]]) {
                    $gambar = "assets/img/penyakit/" . $argpkt[$idpkt[1]];
                } else {
                    $gambar = "assets/img/noimage.png";
                }
                ?>
                <div class="attachment-block clearfix">
                    <div class="row">
                        <div class="d-flex">
                            <div class="col-8">
                                <h4 class="mt-3 mb-4">Hasil Diagnosa</h4>
                                <div class="callout callout-secondary">
                                    <h5>Jenis Penyakit yang diderita Adalah</h5>

                                    <h3 class="text text-success"><b><?= $nmpkt[1]; ?> / <?= round($vlpkt[1], 2); ?> (<?= $vlpkt[1]; ?>)</b></h3>
                                </div>
                            </div>
                            <div class="col">
                                <img class="card-img-top img-bordered-sm rounded" src="<?= $gambar; ?>" height="200">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail -->
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5><?= $ardpkt[$idpkt[1]]; ?></h5>
                    </div>
                </div>

                <!-- Saran -->
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Saran</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5><?= $arspkt[$idpkt[1]]; ?></h5>
                    </div>
                </div>

                <!-- Kemungkinan Lain -->
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Kemungkinan Lain :</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        for ($ipl = 2; $ipl < count($idpkt); $ipl++) {
                        ?>
                            <h4><i class='far fa-caret-square-right'></i> <?= $nmpkt[$ipl]; ?></b> / <?= round($vlpkt[$ipl], 2); ?> % (<?= $vlpkt[$ipl]; ?>)<br></h4>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>