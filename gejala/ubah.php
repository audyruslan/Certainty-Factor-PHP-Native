<?php
session_start();
require '../functions.php';

function ubah_gejala($data)
{
    global $conn;
    $id = $data["id"];
    $nama_gejala = $data['nama_gejala'];

    $query = "UPDATE gejala_penyakit SET
				nama_gpenyakit = '$nama_gejala'
                WHERE kode_gpenyakit = $id
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah_gejala($_POST) > 0) {
        $_SESSION['status'] = "Data Gejala Penyakit";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../gejala.php");
    } else {
        $_SESSION['status'] = "Data Gejala Penyakit";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../gejala.php");
    }
}
