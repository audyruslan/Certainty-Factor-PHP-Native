<?php
session_start();
require 'functions.php';

$id = $_GET["id"];

if (hapus_riwayatHama($id) > 0) {
    $_SESSION['status'] = "Data Hasil Riwayat Hama";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: riwayat_hama.php");
} else {
    $_SESSION['status'] = "Data Hasil Riwayat Hama";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: riwayat_hama.php");
}
