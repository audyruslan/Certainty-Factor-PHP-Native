<?php
session_start();
require '../functions.php';

function tambah_kondisi($data)
{
    global $conn;
    $kondisi = $data['kondisi'];

    $query = "INSERT INTO kondisi_hama
                (kondisi)
				VALUES 
				('$kondisi')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Data Menu
if (isset($_POST["tambah"])) {

    if (tambah_kondisi($_POST) > 0) {
        $_SESSION['status'] = "Data Kondisi Hama";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../kondisi_hama.php");
    } else {
        $_SESSION['status'] = "Data Kondisi Hama";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../kondisi_hama.php");
    }
}
