<?php
session_start();
$title = "Administrator - Certainty Factor (CF)";
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
                    <h1 class="m-0">Riwayat</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Riwayat</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <?php

                    $sqlpkt = mysqli_query($conn, "SELECT * FROM penyakit order by kode_penyakit+0");
                    while ($rpkt = mysqli_fetch_array($sqlpkt)) {
                        $arpkt[$rpkt['kode_penyakit']] = $rpkt['nama_penyakit'];
                        $ardpkt[$rpkt['kode_penyakit']] = $rpkt['det_penyakit'];
                        $arspkt[$rpkt['kode_penyakit']] = $rpkt['srn_penyakit'];
                    }
                    ?>
                    <table id="example" class="table table-bordered table-hover">
                        <thead class="bg-secondary">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Penyakit</th>
                                <th>Nilai CF</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        $i = 1;
                        $counter = 1;
                        $hasil = mysqli_query($conn, "SELECT * FROM hasil ORDER BY id_hasil");
                        while ($r = mysqli_fetch_array($hasil)) {
                            if ($r[0] > 0) {
                                if ($counter % 2 == 0)
                                    $warna = "bg-default";
                                else
                                    $warna = "bg-light";
                        ?>
                                <tr class="<?= $warna; ?>">
                                    <td><?= $i; ?></td>
                                    <td><?= $r[1]; ?></td>
                                    <td><?= $arpkt[$r[4]]; ?></td>
                                    <td><?= $r[5]; ?></td>
                                    <td align=center>
                                        <a class="btn btn-default btn-xs" target="_blank" href="riwayat-detail.php?id=<?= $r[0]; ?>"><i class="fas fa-eye"></i> Detail</a> &nbsp;
                                        <a class="btn btn-danger btn-xs hapus_riwayat" href="riwayat_hapus.php?id=<?= $r[0]; ?>"><i class="fas fa-trash"></i> Hapus</a> &nbsp;
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <?php $counter++; ?>
                            <?php } ?>
                        <?php } ?>
                    </table>
                </div>
                <div class="col-4">
                    <div class="card card-secondary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie"></i>
                                Grafik
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="donut-chart" style="width:100%;height:250px;"></div>
                            <hr>
                            <div id="legend-container"></div>
                        </div>
                        <!-- /.card-body-->
                    </div>
                </div>
            </div>


    </section>
</div>


<?php
require 'layouts/footer.php'; ?>