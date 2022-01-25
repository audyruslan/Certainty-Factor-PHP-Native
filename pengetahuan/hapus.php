<?php
session_start();
require '../functions.php';

$id = $_GET["id"];

if (hapus_pengetahuan($id) > 0) {
    $_SESSION['status'] = "Data Pengetahuan";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../pengetahuan.php");
} else {
    $_SESSION['status'] = "Data Pengetahuan";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../pengetahuan.php");
}
