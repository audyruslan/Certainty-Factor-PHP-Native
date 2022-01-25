<?php
session_start();
require '../functions.php';

$id = $_GET["id"];

// Query Data Hama
$sql = mysqli_query($conn, "SELECT * FROM hama
                    WHERE kode_hama = '$id'");
$hama = mysqli_fetch_assoc($sql);

// Hapus Gambar Hama
$gambar = $hama['gambar'];
if (file_exists("../assets/img/hama/$gambar")) {
    unlink("../assets/img/hama/$gambar");
}
if (hapus_hama($id) > 0) {
    $_SESSION['status'] = "Data Hama";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../hama.php");
} else {
    $_SESSION['status'] = "Data Hama";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../hama.php");
}
