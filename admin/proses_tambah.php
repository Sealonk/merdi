<?php
// Wajib memanggil autoload dari Composer untuk menggunakan library Google Cloud
require __DIR__ . '/../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;

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
    $tmp_name = $_FILES['foto']['tmp_name'];

    // Inisialisasi Google Cloud Storage
    // Pastikan mengganti 'ID_PROYEK_GOOGLE_CLOUD_ANDA' dengan Project ID Anda
    $storage = new StorageClient([
        'projectId' => 'merdi-502214'
    ]);
    
    // Pastikan mengganti 'nama-bucket-kontrakan-anda' dengan nama Bucket Anda yang sebenarnya
    $bucket = $storage->bucket('kontrakan_merdi'); 

    // Proses upload file ke Cloud Bucket
    $bucket->upload(
        fopen($tmp_name, 'r'),
        [
            'name' => $foto
        ]
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