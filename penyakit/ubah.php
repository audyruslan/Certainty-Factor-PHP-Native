<?php
session_start();
require '../functions.php';

function ubah_penyakit($data)
{
    global $conn;
    $id = $data["id"];
    $nama_penyakit = $data['nama_penyakit'];
    $det_penyakit = $data['Edet_penyakit'];
    $srn_penyakit = $data['Esrn_penyakit'];
    $gambarLama = $data["gambarLama"];

    // Query Image Siswa
    $sql = mysqli_query($conn, "SELECT * FROM penyakit WHERE kode_penyakit = '$id'");
    $row = mysqli_fetch_assoc($sql);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        // Delete Gambar Penyakit 
        $gambar = $row['gambar'];
        if (file_exists("../assets/img/penyakit/$gambar")) {
            unlink("../assets/img/penyakit/$gambar");
        }
        $gambar = upload_gambar();
    }

    $query = "UPDATE penyakit SET
                nama_penyakit = '$nama_penyakit',
                det_penyakit = '$det_penyakit',
                srn_penyakit = '$srn_penyakit',
                gambar = '$gambar'
                WHERE kode_penyakit = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah_penyakit($_POST) > 0) {
        $_SESSION['status'] = "Data Penyakit";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../penyakit.php");
    } else {
        $_SESSION['status'] = "Data Penyakit";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../penyakit.php");
    }
}
