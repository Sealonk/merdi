<?php
// Wajib memanggil autoload dari Composer
require __DIR__ . '/../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;

include "koneksi.php";

$id = $_GET['id'];

// 1. Ambil nama file foto dari database SEBELUM datanya dihapus
$query = mysqli_query($conn, "SELECT foto FROM kontrakan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
$nama_foto = $data['foto'];

// 2. Hapus foto dari Google Cloud Storage jika file-nya ada
if (!empty($nama_foto)) {
    // Inisialisasi Google Cloud Storage
    // Ganti 'ID_PROYEK_GOOGLE_CLOUD_ANDA' dengan Project ID Anda
    $storage = new StorageClient([
        'projectId' => 'merdi-502214'
    ]);
    
    // Menggunakan nama bucket Anda
    $bucket = $storage->bucket('kontrakan_merdi'); 
    
    // Menargetkan file spesifik yang ingin dihapus
    $object = $bucket->object($nama_foto);

    // Pastikan file benar-benar ada di bucket sebelum menjalankan perintah delete
    if ($object->exists()) {
        $object->delete();
    }
}

// 3. Hapus baris data dari database MySQL
mysqli_query($conn, "DELETE FROM kontrakan WHERE id='$id'");

// 4. Redirect kembali ke halaman data kontrakan
header("Location: data_kontrakan.php");
exit;
?>