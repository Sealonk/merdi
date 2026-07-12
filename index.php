<?php
// Ambil path URL yang sedang diakses
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Arahkan domain utama ke landing page pengguna
if ($path === '/' || $path === '/index.php' || $path === '') {
    header('Location: /pengguna/landing.php');
    exit;
}

$file = __DIR__ . $path;

// PENTING: Jika user mengakses folder (misal: /admin/), otomatis arahkan ke file index.php di dalamnya
if (is_dir($file)) {
    $file = rtrim($file, '/') . '/index.php';
}

// Cek apakah file yang diminta benar-benar ada dan merupakan PHP
if (file_exists($file) && is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    chdir(dirname($file));
    require basename($file);
} else {
    // Jika file tidak ditemukan, berikan pesan 404
    http_response_code(404);
    echo "404 Not Found - Halaman yang Anda cari tidak ditemukan.";
}
?>