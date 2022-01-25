<?php
session_start();
require '../functions.php';

function ubah_pengetahuan($data)
{
    global $conn;
    $id = $data["id"];
    $kode_penyakit = $data['kode_penyakit'];
    $kode_gejala = $data['kode_gejala'];
    $mb = $data['mb'];
    $md = $data['md'];

    $query = "UPDATE basis_pengetahuan SET
				kode_penyakit = '$kode_penyakit',
				kode_gejala = '$kode_gejala',
				mb = '$mb',
				md = '$md'
                WHERE kode_pengetahuan = $id
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah_pengetahuan($_POST) > 0) {
        $_SESSION['status'] = "Data Pengetahuan";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../pengetahuan.php");
    } else {
        $_SESSION['status'] = "Data Pengetahuan";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../pengetahuan.php");
    }
}
