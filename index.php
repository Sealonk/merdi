<?php
// Ambil path URL yang sedang diakses (misal: /pengguna/landing.php)
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Jika user mengakses domain utama secara langsung, arahkan ke landing page pengguna
if ($path === '/' || $path === '/index.php' || $path === '') {
    header('Location: /pengguna/landing.php');
    exit;
}

// Cari lokasi absolut file di dalam server
$file = __DIR__ . $path;

// Cek apakah file yang diminta itu ada dan merupakan file .php
if (file_exists($file) && is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    // PENTING: Ubah direktori kerja ke folder tempat file tersebut berada.
    // Ini memastikan script Anda seperti "include '../koneksi.php'" tidak error.
    chdir(dirname($file));
    require basename($file);
} else {
    // Jika file tidak ditemukan, berikan pesan 404
    http_response_code(404);
    echo "404 Not Found - Halaman yang Anda cari tidak ditemukan.";
}
?>