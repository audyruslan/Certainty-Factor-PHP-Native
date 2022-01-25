<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
$title = "Pengetahuan Hama - Certainty Factor (CF)";
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
                    <h1 class="m-0">Basis Pengetahuan Hama</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Pengetahuan Hama</li>
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
                    <div class="col-12">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary ml-2 mt-3 mb-3" data-toggle="modal" data-target="#tambahModal">
                            Tambah Pengetahuan Hama
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengetahuan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="pengetahuan_hama/tambah.php" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="kode_penyakit">Hama</label>
                                                <select class="form-control" name="kode_penyakit" id="kode_penyakit">
                                                    <option>--Pilih Penyakit--</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "SELECT * FROM hama");
                                                    while ($penyakit = mysqli_fetch_assoc($query)) {
                                                    ?>
                                                        <option value="<?= $penyakit["kode_hama"]; ?>"><?= $penyakit["nama_hama"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_gejala">Gejala</label>
                                                <select class="form-control" name="kode_gejala" id="kode_gejala">
                                                    <option>--Pilih Gejala--</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "SELECT * FROM gejala_hama");
                                                    while ($gejala = mysqli_fetch_assoc($query)) {
                                                    ?>
                                                        <option value="<?= $gejala["kode_ghama"]; ?>"><?= substr($gejala["nama_ghama"], 0, 50); ?>......</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="mb">Masukkan MB</label>
                                                <input type="text" autocomplete="off" class="form-control" id="mb" name="mb" placeholder="Masukkan MB">
                                            </div>
                                            <div class="form-group">
                                                <label for="md">Masukkan MD</label>
                                                <input type="text" autocomplete="off" class="form-control" id="md" name="md" placeholder="Masukkan MD">
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
                                        <th>Nama Penyakit</th>
                                        <th>Nama Gejala</th>
                                        <th>MB</th>
                                        <th>MD</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM pengetahuan_hama
                                                            INNER JOIN hama
                                                            ON pengetahuan_hama.kode_hama = hama.kode_hama
                                                            INNER JOIN gejala_hama
                                                            ON pengetahuan_hama.kode_ghama = gejala_hama.kode_ghama");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row['nama_hama']; ?></td>
                                        <td><?= $row['nama_ghama']; ?></td>
                                        <td><?= $row['mb']; ?></td>
                                        <td><?= $row['md']; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm ubah" data-toggle="modal" data-target="#EditModal<?= $row["kode_pengetahuan"]; ?>"><i class="fas fa-edit"></i> </a>
                                            <a class="btn btn-danger btn-sm hapus_pengetahuanHama" href="pengetahuan_hama/hapus.php?id=<?= $row["kode_pengetahuan"]; ?>"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="EditModal<?= $row["kode_pengetahuan"]; ?>" tabindex="-1" role="dialog" aria-labelledby="#EditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="EditModalLabel">Ubah Gejala</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="pengetahuan_hama/ubah.php" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $row["kode_pengetahuan"]; ?>">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="kode_penyakit">Penyakit</label>
                                                                    <select class="form-control" name="kode_penyakit" id="kode_penyakit">
                                                                        <option>--Pilih Penyakit--</option>
                                                                        <?php
                                                                        $query = mysqli_query($conn, "SELECT * FROM hama");
                                                                        while ($penyakit = mysqli_fetch_assoc($query)) {
                                                                        ?>
                                                                            <option value="<?= $penyakit["kode_hama"]; ?>" <?php if ($row["kode_hama"] == $penyakit["kode_hama"]) echo "selected" ?>><?= $penyakit["nama_hama"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kode_gejala">Gejala</label>
                                                                    <select class="form-control" name="kode_gejala" id="kode_gejala">
                                                                        <option>--Pilih Gejala--</option>
                                                                        <?php
                                                                        $query = mysqli_query($conn, "SELECT * FROM gejala_hama");
                                                                        while ($gejala = mysqli_fetch_assoc($query)) {
                                                                        ?>
                                                                            <option value="<?= $gejala["kode_ghama"]; ?>" <?php if ($row["kode_ghama"] == $gejala["kode_ghama"]) echo "selected" ?>><?= $gejala["nama_ghama"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="mb">Masukkan MB</label>
                                                                    <input type="text" autocomplete="off" class="form-control" id="mb" name="mb" value="<?= $row["mb"]; ?>" placeholder="Masukkan MB">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="md">Masukkan MD</label>
                                                                    <input type="text" autocomplete="off" class="form-control" id="md" name="md" value="<?= $row["md"]; ?>" placeholder="Masukkan MD">
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