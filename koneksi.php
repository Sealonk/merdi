<?php
$user = "merdi"; 
$pass = "1N1p455w0r17c4174n94n!"; // Ganti dengan password Cloud SQL
$db   = "lbs_kontrakan";

// Deteksi jika aplikasi sedang berjalan di Google App Engine
if (getenv('GAE_ENV') == 'standard') {
    // Koneksi menggunakan Unix Socket khusus App Engine
    $instance_name = "merdi-502214:asia-southeast2:merdi"; // Ganti dengan Instance Connection Name Anda
    $socket = "/cloudsql/" . $instance_name;
    $conn = mysqli_connect(null, $user, $pass, $db, null, $socket);
} else {
    // Koneksi jika dijalankan di XAMPP lokal
    $host = "localhost";
    $pass_lokal = ""; 
    $conn = mysqli_connect($host, $user, $pass_lokal, $db);
}

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>