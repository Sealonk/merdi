<?php
// Wajib memanggil autoload dari Composer
require __DIR__ . '/../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;

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

    $nama_foto_asli = $_FILES['foto']['name'];
    // Tambahkan time() agar nama file unik di bucket
    $foto_baru = time() . "_" . $nama_foto_asli;
    $tmp = $_FILES['foto']['tmp_name'];

    // Inisialisasi Google Cloud Storage
    // Ganti 'ID_PROYEK_GOOGLE_CLOUD_ANDA' dengan Project ID Anda
    $storage = new StorageClient([
        'projectId' => 'merdi-502214'
    ]);
    
    // Ganti 'nama-bucket-kontrakan-anda' dengan nama Bucket Anda
    $bucket = $storage->bucket('kontrakan_merdi'); 

    // Proses upload file ke Cloud Bucket
    $bucket->upload(
        fopen($tmp, 'r'),
        [
            'name' => $foto_baru
        ]
    );

    $foto = $foto_baru;

} else {

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