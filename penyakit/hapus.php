<?php
session_start();
require '../functions.php';

$id = $_GET["id"];

// Query Data Penyakit
$sql = mysqli_query($conn, "SELECT * FROM penyakit
                    WHERE kode_penyakit = '$id'");
$penyakit = mysqli_fetch_assoc($sql);

// Hapus Gambar Penyakit
$gambar = $penyakit['gambar'];
if (file_exists("../assets/img/penyakit/$gambar")) {
    unlink("../assets/img/penyakit/$gambar");
}
if (hapus_penyakit($id) > 0) {
    $_SESSION['status'] = "Data Penyakit";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../penyakit.php");
} else {
    $_SESSION['status'] = "Data Penyakit";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../penyakit.php");
}
