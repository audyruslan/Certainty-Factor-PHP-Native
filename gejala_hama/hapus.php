<?php
session_start();
require '../functions.php';

$id = $_GET["id"];

if (hapus_gejalaHama($id) > 0) {
    $_SESSION['status'] = "Data Gejala Hama";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../gejala_hama.php");
} else {
    $_SESSION['status'] = "Data Gejala Hama";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../gejala_hama.php");
}
