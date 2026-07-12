<?php

include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$harga = $_POST['harga'];
$fasilitas = $_POST['fasilitas'];
$keterangan = $_POST['keterangan'];

$foto_lama = $_POST['foto_lama'];

if($_FILES['foto']['name'] != ""){

    $foto_baru = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "foto/".$foto_baru);

    $foto = $foto_baru;

}else{

    $foto = $foto_lama;

}

$query = mysqli_query($conn, "UPDATE kontrakan SET
nama='$nama',
alamat='$alamat',
latitude='$latitude',
longitude='$longitude',
harga='$harga',
fasilitas='$fasilitas',
keterangan='$keterangan',
foto='$foto'
WHERE id='$id'");

if($query){
    header("Location: data_kontrakan.php");
    exit;
}else{
    echo mysqli_error($conn);
}

?>