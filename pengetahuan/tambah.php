<?php
session_start();
require '../functions.php';

function tambah_pengetahuan($data)
{
    global $conn;

    $kode_penyakit = $data['kode_penyakit']; 
    $kode_gejala = $data['kode_gejala'];
    $mb = $data['mb'];
    $md = $data['md'];

    $query = "INSERT INTO basis_pengetahuan
                (kode_penyakit,kode_gejala,mb,md)
				VALUES 
				('$kode_penyakit','$kode_gejala','$mb','$md')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Data Menu
if (isset($_POST["tambah"])) {

    if (tambah_pengetahuan($_POST) > 0) {
        $_SESSION['status'] = "Data Pegetahuan";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../pengetahuan.php");
    } else {
        $_SESSION['status'] = "Data Pegetahuan";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../pengetahuan.php");
    }
}
