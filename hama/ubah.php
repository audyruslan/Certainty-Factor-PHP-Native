<?php
session_start();
require '../functions.php';

function ubah_hama($data)
{
    global $conn;
    $id = $data["id"];
    $nama_hama = $data['nama_hama'];
    $det_hama = $data['Edet_hama'];
    $srn_hama = $data['Esrn_hama'];
    $gambarLama = $data["gambarLama"];

    // Query Image Siswa
    $sql = mysqli_query($conn, "SELECT * FROM hama WHERE kode_hama = '$id'");
    $row = mysqli_fetch_assoc($sql);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        // Delete Gambar hama 
        $gambar = $row['gambar'];
        if (file_exists("../assets/img/hama/$gambar")) {
            unlink("../assets/img/hama/$gambar");
        }
        $gambar = upload_gambarHama();
    }

    $query = "UPDATE hama SET
                nama_hama = '$nama_hama',
                det_hama = '$det_hama',
                srn_hama = '$srn_hama',
                gambar = '$gambar'
                WHERE kode_hama = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah_hama($_POST) > 0) {
        $_SESSION['status'] = "Data Hama";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../hama.php");
    } else {
        $_SESSION['status'] = "Data Hama";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../hama.php");
    }
}
