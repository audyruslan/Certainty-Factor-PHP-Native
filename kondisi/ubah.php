<?php
session_start();
require '../functions.php';

function ubah_kondisi($data)
{
    global $conn;
    $id = $data["id"];
    $kondisi = $data['kondisi'];

    $query = "UPDATE kondisi_penyakit
                SET
				kondisi = '$kondisi'
                WHERE id = $id
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah_kondisi($_POST) > 0) {
        $_SESSION['status'] = "Data Kondisi Penyakit";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../kondisi.php");
    } else {
        $_SESSION['status'] = "Data Kondisi Penyakit";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../kondisi.php");
    }
}
