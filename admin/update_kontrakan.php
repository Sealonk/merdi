<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama_kontrakan'];
$alamat = $_POST['alamat'];
$kecamatan = $_POST['kecamatan'];
$harga = $_POST['harga'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$no_hp = $_POST['no_hp'];

// cek upload foto
$foto = $_FILES['foto']['name'];

if ($foto != "") {
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/" . $foto);

    mysqli_query($conn, "UPDATE kontrakan SET 
        nama_kontrakan='$nama',
        alamat='$alamat',
        kecamatan='$kecamatan',
        harga='$harga',
        latitude='$latitude',
        longitude='$longitude',
        no_hp='$no_hp',
        foto='$foto'
        WHERE id='$id'
    ");
} else {
    mysqli_query($conn, "UPDATE kontrakan SET 
        nama_kontrakan='$nama',
        alamat='$alamat',
        kecamatan='$kecamatan',
        harga='$harga',
        latitude='$latitude',
        longitude='$longitude',
        no_hp='$no_hp'
        WHERE id='$id'
    ");
}

header("Location: data_kontrakan.php");
?>