<?php
session_start();
require '../functions.php';

$id = $_GET["id"];

// Query Data Post
$sql = mysqli_query($conn, "SELECT * FROM post
                    WHERE kode_post = '$id'");
$post = mysqli_fetch_assoc($sql);

// Hapus Gambar post
$gambar = $post['gambar'];
if (file_exists("../assets/img/posting/$gambar")) {
    unlink("../assets/img/posting/$gambar");
}
if (hapus_post($id) > 0) {
    $_SESSION['status'] = "Data post";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../post.php");
} else {
    $_SESSION['status'] = "Data post";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../post.php");
}
