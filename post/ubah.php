<?php
session_start();
require '../functions.php';

function ubah_post($data)
{
    global $conn;
    $id = $data["id"];
    $nama_post = $data['nama_post'];
    $det_post = $data['Edet_post'];
    $srn_post = $data['Esrn_post'];
    $gambarLama = $data["gambarLama"];

    // Query Gambar Postingan
    $sql = mysqli_query($conn, "SELECT * FROM post WHERE kode_post = '$id'");
    $row = mysqli_fetch_assoc($sql);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        // Delete Gambar Post
        $gambar = $row['gambar'];
        if (file_exists("../assets/img/posting/$gambar")) {
            unlink("../assets/img/posting/$gambar");
        }
        $gambar = upload_Post();
    }

    $query = "UPDATE post SET
                nama_post = '$nama_post',
                det_post = '$det_post',
                srn_post = '$srn_post',
                gambar = '$gambar'
                WHERE kode_post = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah_post($_POST) > 0) {
        $_SESSION['status'] = "Data Post";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../post.php");
    } else {
        $_SESSION['status'] = "Data Post";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../post.php");
    }
}
