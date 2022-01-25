<?php
session_start();
require '../functions.php';

function tambah_post($data)
{
    global $conn;

    $nama_post = $data['nama_post'];
    $det_post = $data['det_post'];
    $srn_post = $data['srn_post'];

    // Upload Gambar
    $gambar = upload_Post();

    $query = "INSERT INTO post
                (nama_post,det_post,srn_post,gambar)
				VALUES 
				('$nama_post','$det_post','$srn_post','$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Data Post
if (isset($_POST["tambah"])) {

    if (tambah_post($_POST) > 0) {
        $_SESSION['status'] = "Data Post";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../post.php");
    } else {
        $_SESSION['status'] = "Data Post";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../post.php");
    }
}
