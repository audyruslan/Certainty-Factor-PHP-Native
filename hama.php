<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
$title = "Hama - Certainty Factor (CF)";
require 'layouts/header.php';
require 'layouts/navbar.php';
require 'functions.php';

$user = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$user'");
$admin = mysqli_fetch_assoc($query);
require 'layouts/sidebar.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Hama</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Hama</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-secondary">
                <div class="row">
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary ml-2 mt-3 mb-3" data-toggle="modal" data-target="#tambahModal">
                            Tambah Data 
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Hama</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="hama/tambah.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="det_hama">Detail hama</label>
                                                        <textarea class="form-control" name="det_hama" id="det_hama" cols="30" placeholder="Detail hama"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="srn_hama">Saran hama</label>
                                                        <textarea class="form-control" name="srn_hama" id="srn_hama" cols="30" placeholder="Saran hama"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="nama_hama">Nama Hama</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="nama_hama" name="nama_hama" placeholder="Nama hama">
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="drop-zone">
                                                            <span class="drop-zone__prompt"><i class="fas fa-upload"></i> Drop file here or click to upload</span>
                                                            <input type="file" name="gambar" id="gambar" class="drop-zone__input">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-hover" id="example" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Hama</th>
                                        <th>Detail Hama</th>
                                        <th>Saran Hama</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM hama");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row['nama_hama']; ?></td>
                                        <td><?= $row['det_hama']; ?></td>
                                        <td><?= $row['srn_hama']; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm ubah" data-toggle="modal" data-target="#EditModal<?= $row["kode_hama"]; ?>"><i class="fas fa-edit"></i> </a>
                                            <a class="btn btn-danger btn-sm hapus_hama" href="hama/hapus.php?id=<?= $row["kode_hama"]; ?>"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="EditModal<?= $row["kode_hama"]; ?>" tabindex="-1" role="dialog" aria-labelledby="#EditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="EditModalLabel">Ubah hama</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="hama/ubah.php" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $row["kode_hama"]; ?>">
                                                        <input type="hidden" name="gambarLama" value="<?= $row["gambar"]; ?>">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <label for="Edet_hama">Detail hama</label>
                                                                    <textarea class="form-control" name="Edet_hama" id="Edet_hama" cols="30" placeholder="Detail hama"><?= $row["det_hama"]; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Esrn_hama">Saran hama</label>
                                                                    <textarea class="form-control" name="Esrn_hama" id="Esrn_hama" cols="30" placeholder="Saran hama">
                                                                        <?= $row["srn_hama"]; ?>
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="nama_hama">Nama Hama/hama</label>
                                                                    <input type="text" autocomplete="off" class="form-control" id="nama_hama" value="<?= $row["nama_hama"]; ?>" name="nama_hama" placeholder="Nama hama">
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="drop-zone">
                                                                        <span class="drop-zone__prompt"><i class="fas fa-upload"></i> Drop file here or click to upload</span>
                                                                        <input type="file" name="gambar" id="gambar" class="drop-zone__input">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembail</button>
                                                        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?>

                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>