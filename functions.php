<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "cf");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Hapus Data Basis Pengetahuan Hama
function hapus_pengetahuanHama($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pengetahuan_hama WHERE kode_pengetahuan = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Basis Pengetahuan Penyakit    
function hapus_pengetahuanPenyakit($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pengetahuan_penyakit WHERE kode_pengetahuan = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Hama
function hapus_hama($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM hama WHERE kode_hama = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Penyakit
function hapus_penyakit($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM penyakit WHERE kode_penyakit = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Admin
function hapus_admin($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM admin WHERE username = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Gejala Hama
function hapus_gejalaHama($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM gejala_hama WHERE kode_ghama = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Gejala Penyakit
function hapus_gejalaPenyakit($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM gejala_penyakit WHERE kode_gpenyakit = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Post Keterangan
function hapus_post($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM post WHERE kode_post = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Hasil Riwayat Hama
function hapus_riwayatHama($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM hasil_hama WHERE id_hasil = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Hasil Riwayat Penyakit
function hapus_riwayatPenyakit($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM hasil_penyakit WHERE id_hasil = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Kondisi Hama
function hapus_kondisiHama($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kondisi_hama WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Kondisi Penyakit
function hapus_kondisiPenyakit($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kondisi_penyakit WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// Upload Gambar Hama
function upload_gambarHama()
{
    $namaFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmpName, '../assets/img/hama/' . $namaFile);

    return $namaFile;
}

// Upload Gambar Penyakit
function upload_gambarPenyakit()
{
    $namaFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmpName, '../assets/img/penyakit/' . $namaFile);

    return $namaFile;
}

// Upload Gambar Post
function upload_Post()
{
    $namaFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmpName, '../assets/img/posting/' . $namaFile);

    return $namaFile;
}

// Upload Gambar Hama
function upload_Hama()
{
    $namaFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmpName, '../assets/img/hama/' . $namaFile);

    return $namaFile;
}

function avatar($character)
{
    $path = "image/" . time() . ".png";
    $image = imagecreate(200, 200);
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);
    $textcolor = imagecolorallocate($image, 255, 255, 255);

    $font = dirname(__FILE__) . "/assets/font/arial.ttf";

    imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
    imagepng($image, $path);
    imagedestroy($image);
    return $path;
}
