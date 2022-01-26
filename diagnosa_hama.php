<?php
$title = "Diagnosa Hama - Certainty Factor (CF)";
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
                    <h1 class="m-0">Diagnosa Hama</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Diagnosa Hama</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php
            if (isset($_POST["submit"])) {
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
                    $arkondisitext[$rkondisi[0]] = $rkondisi[1];
                }

                $sqlpkt = mysqli_query($conn, "SELECT * FROM hama order by kode_hama+0");
                while ($rpkt = mysqli_fetch_array($sqlpkt)) {
                    $arpkt[$rpkt[0]] = $rpkt[1];
                    $ardpkt[$rpkt[0]] = $rpkt[2];
                    $arspkt[$rpkt[0]] = $rpkt[3];
                    $argpkt[$rpkt[0]] = $rpkt[4];
                }

                //print_r($arkondisitext);
                // -------- perhitungan certainty factor (CF) ---------
                // --------------------- START ------------------------
                 $sqlhama = mysqli_query($conn, "SELECT * FROM hama order by kode_hama");
                    $arhama = array();
                    while ($rhama = mysqli_fetch_array($sqlhama)) {
                        $cftotal_temp = 0;
                        $cf = 0;
                        $sqlgejala = mysqli_query($conn, "SELECT * FROM pengetahuan_hama WHERE kode_hama=$rhama[kode_hama]");
                        $cflama = 0;
                        while ($rgejala = mysqli_fetch_array($sqlgejala)) {
                        $arkondisi = explode("_", $_POST['kondisi'][0]);
                        $gejala = $arkondisi[0];
                        $tes = $rgejala[1];

                            for ($i = 0; $i < count($_POST['kondisi']); $i++) {
                                $arkondisi = explode("_", $_POST['kondisi'][$i]);
                                $gejala = $arkondisi[0];
                                if ($rgejala[1] == $gejala) {
                                $cf = ($rgejala[3] - $rgejala[4]) * $arbobot[$arkondisi[1]];
                                if (($cf >= 0) && ($cf * $cflama >= 0)) {
                                    $cflama = $cflama + ($cf * (1 - $cflama));
                                }
                                if ($cf * $cflama < 0) {
                                    $cflama = ($cflama + $cf) / (1 - Min(abs($cflama), abs($cf)));
                                }
                                if (($cf < 0) && ($cf * $cflama >= 0)) {
                                    $cflama = $cflama + ($cf * (1 + $cflama));
                                }
                                }
                            }
                        }
                        if ($cflama > 0) {
                        $arhama += array($rhama[1] => number_format($cflama, 4));
                        }
                    }

                    arsort($arhama);

                    $inpgejala = serialize($argejala);
                    $inphama = serialize($arhama);

                    $np1 = 0;
                    foreach ($arhama as $key1 => $value1) {
                        $np1++;
                        $idpkt1[$np1] = $key1;
                        $vlpkt1[$np1] = $value1;
                    }

                    mysqli_query($conn, "INSERT INTO hasil_hama(
                                tanggal,
                                ghama,
                                hama,
                                hasil_id,
                                hasil_nilai
                                ) 
                            VALUES(
                                '$inptanggal',
                                '$inpgejala',
                                '$inphama',
                                '$idpkt1[1]',
                                '$vlpkt1[1]'
                                )");

                // --------------------- END -------------------------  
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
                foreach ($arhama as $key => $value) {
                    $np++;
                    $idpkt[$np] = $key;
                    $nmpkt[$np] = $arpkt[$key];
                    $vlpkt[$np] = $value;
                }
                if ($argpkt[$idpkt[1]]) {
                    $gambar = "assets/img/hama/" . $argpkt[$idpkt[1]];
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
                                    <h5>Jenis hama yang diderita Adalah</h5>

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

            <?php } else { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian !</h5>
                            <p>Silahkan memilih gejala sesuai dengan kondisi tanaman jagung anda, anda dapat memilih kepastian kondisi tanaman jagung anda dari pasti, tidak, sampai pasti ya, jika sudah tekan tombol proses (<i class="icon fas fa-search-plus"></i>) di bawah untuk melihat hasil.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <form action="" method="POST">
                            <table id="example" class="table table-bordered table-hover pilihkondisi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Gejala</th>
                                        <th>Pilih Kondisi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql3 = mysqli_query($conn, "SELECT * FROM gejala_hama order by kode_ghama");
                                while ($r3 = mysqli_fetch_array($sql3)) {
                                ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td>G<?= str_pad($r3[0], 3, '0', STR_PAD_LEFT); ?></td>
                                        <td><?= $r3[1]; ?></td>
                                        <td>
                                            <select class="form-control" name="kondisi[]" id="sl<?= $i; ?>" class="opsikondisi">
                                                <option data-id="0" value="0">Pilih jika sesuai</option>
                                                <?php
                                                $s = "SELECT * FROM kondisi_hama ORDER BY id";
                                                $q = mysqli_query($conn, $s) or die($s);
                                                while ($rw = mysqli_fetch_array($q)) {
                                                ?>
                                                    <option data-id="<?= $rw['id']; ?>" value="<?= $r3['kode_ghama'] . '_' . $rw['id']; ?>"><?= $rw['kondisi']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>

                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                var arcolor = new Array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700');
                                                setColor();
                                                $(".pilihkondisi").on("change", "tr td select #sl<?= $i; ?>", function() {
                                                    setColor();
                                                });

                                                function setColor() {
                                                    var selectedItem = $("tr td select#sl<?= $i; ?> :selected");
                                                    var color = arcolor[selectedItem.data("id")];
                                                    $("tr td select #sl<?= $i; ?>.opsikondisi").css("background-color", color);
                                                    console.log(color);
                                                }
                                            });
                                        </script>
                                    </tr>
                                    <?php $i++; ?>

                                <?php
                                }
                                ?>
                            </table>
                            <button type="submit" class="float" name="submit"><i class="icon fas fa-search-plus"></i></button>

                        </form>
                    </div>
                </div>

            <?php } ?>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>