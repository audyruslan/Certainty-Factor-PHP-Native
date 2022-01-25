<?php
session_start();
require '../functions.php';

function tambah_gejala($data)
{
    global $conn;

    $nama_gejala = $data['nama_gejala'];

    $query = "INSERT INTO gejala_hama
                (nama_ghama)
				VALUES 
				('$nama_gejala')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Data Menu
if (isset($_POST["tambah"])) {

    if (tambah_gejala($_POST) > 0) {
        $_SESSION['status'] = "Data Gejala Hama";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../gejala_hama.php");
    } else {
        $_SESSION['status'] = "Data Gejala Hama";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../gejala_hama.php");
    }
}
