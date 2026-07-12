<?php

include '../koneksi.php';

$nama_kontrakan = $_POST['nama'];
$alamat         = $_POST['alamat'];
$kecamatan      = $_POST['kecamatan'];
$harga          = $_POST['harga'];
$no_hp          = $_POST['no_hp'];
$latitude       = $_POST['latitude'];
$longitude      = $_POST['longitude'];

$foto = '';

if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){

    $foto = time() . "_" . $_FILES['foto']['name'];

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "../uploads/" . $foto
    );
}

$query = mysqli_query($conn, "INSERT INTO kontrakan
(
    nama_kontrakan,
    alamat,
    kecamatan,
    harga,
    no_hp,
    latitude,
    longitude,
    foto
)
VALUES
(
    '$nama_kontrakan',
    '$alamat',
    '$kecamatan',
    '$harga',
    '$no_hp',
    '$latitude',
    '$longitude',
    '$foto'
)");

if($query){
    header("Location: data_kontrakan.php");
    exit;
}else{
    echo "Data gagal disimpan: " . mysqli_error($conn);
}
?>