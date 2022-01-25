<?php
session_start();
require '../functions.php';

function tambah_gejala($data)
{
    global $conn;

    $nama_gejala = $data['nama_gejala'];

    $query = "INSERT INTO gejala_penyakit
                (nama_gpenyakit)
				VALUES 
				('$nama_gejala')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Data Menu
if (isset($_POST["tambah"])) {

    if (tambah_gejala($_POST) > 0) {
        $_SESSION['status'] = "Data Gejala Penyakit";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../gejala.php");
    } else {
        $_SESSION['status'] = "Data Gejala Penyakit";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../gejala.php");
    }
}
