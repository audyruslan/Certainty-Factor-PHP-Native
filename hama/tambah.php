<?php
session_start();
require '../functions.php';

function tambah_hama($data)
{
    global $conn;

    $nama_hama = $data['nama_hama'];
    $det_hama = $data['det_hama'];
    $srn_hama = $data['srn_hama'];

    // Upload Gambar
    $gambar = upload_gambarHama();

    $query = "INSERT INTO hama
                (nama_hama,det_hama,srn_hama,gambar)
				VALUES 
				('$nama_hama','$det_hama','$srn_hama','$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Data Hama
if (isset($_POST["tambah"])) {

    if (tambah_hama($_POST) > 0) {
        $_SESSION['status'] = "Data Hama";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../hama.php");
    } else {
        $_SESSION['status'] = "Data Hama";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../hama.php");
    }
}
