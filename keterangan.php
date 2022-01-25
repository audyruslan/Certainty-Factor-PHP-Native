<?php
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
                    <h1 class="m-0">Keterangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Keterangan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Keterangan
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
                            <div class="row">
                                <?php
                                $hasil = mysqli_query($conn, "SELECT * FROM post ORDER BY kode_post");
                                while ($r = mysqli_fetch_array($hasil)) {
                                ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" data-aos="fade-right">
                                        <div class="card text-center">
                                            <img class="card-img-top img-bordered-sm" src="<?php echo 'assets/img/' . $r['gambar']; ?>" alt="" width="100%" height="200">
                                            <div class="card-block">
                                                <h4 class="card-title">
                                                    <h3 class="bg-keterangan"><?php echo $r['nama_post']; ?></h3>
                                                    <a class="btn bg-maroon btn-flat margin" href="#" data-toggle="modal" data-target="#detailModal<?php echo $r['kode_post']; ?>"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Detail</a>
                                                    <a class="btn bg-olive btn-flat margin" href="#" data-toggle="modal" data-target="#saranModal<?php echo $r['kode_post']; ?>"><i class="fa fa-quote-right" aria-hidden="true"></i> Saran</a>
                                            </div>
                                        </div>
                                        <hr>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal<?php echo $r['kode_post']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Untuk <?php echo $r["nama_post"]; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <p><?php echo $r["det_post"]; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Sran -->
                                        <div class="modal fade" id="saranModal<?php echo $r['kode_post']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Saran Untuk <?php echo $r["nama_post"]; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <p><?php echo $r["srn_post"]; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.card-body-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>