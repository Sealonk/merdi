<?php
// Wajib memanggil autoload dari Composer
require __DIR__ . '/../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;

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
$nama_foto_asli = $_FILES['foto']['name'];

if ($nama_foto_asli != "") {
    // Tambahkan time() agar nama file unik di bucket
    $foto = time() . "_" . $nama_foto_asli;
    $tmp = $_FILES['foto']['tmp_name'];

    // Inisialisasi Google Cloud Storage
    // Pastikan mengganti 'ID_PROYEK_GOOGLE_CLOUD_ANDA' dengan Project ID Anda
    $storage = new StorageClient([
        'projectId' => 'merdi-502214'
    ]);
    
    // Pastikan mengganti 'nama-bucket-kontrakan-anda' dengan nama Bucket Anda
    $bucket = $storage->bucket('kontrakan_merdi'); 

    // Proses upload file ke Cloud Bucket
    $bucket->upload(
        fopen($tmp, 'r'),
        [
            'name' => $foto
        ]
    );

    // Update database beserta nama foto baru
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
    // Update database tanpa mengubah foto lama
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