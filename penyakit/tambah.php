<?php
session_start();
require '../functions.php';

function tambah_penyakit($data)
{
    global $conn;

    $nama_penyakit = $data['nama_penyakit'];
    $det_penyakit = $data['det_penyakit'];
    $srn_penyakit = $data['srn_penyakit'];

    // Upload Gambar
    $gambar = upload_gambar();

    $query = "INSERT INTO penyakit
                (nama_penyakit,det_penyakit,srn_penyakit,gambar)
				VALUES 
				('$nama_penyakit','$det_penyakit','$srn_penyakit','$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Data Penyakit
if (isset($_POST["tambah"])) {

    if (tambah_penyakit($_POST) > 0) {
        $_SESSION['status'] = "Data Penyakit";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../penyakit.php");
    } else {
        $_SESSION['status'] = "Data Penyakit";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../penyakit.php");
    }
}
