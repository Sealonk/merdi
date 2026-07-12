<?php
session_start();
include 'koneksi.php';

// =======================
// SECURITY CHECK (ADMIN ONLY)
// =======================
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

// =======================
// AMBIL DATA KONTRAKAN
// =======================
$total = mysqli_query($conn, "SELECT * FROM kontrakan");
$jumlah_kontrakan = mysqli_num_rows($total);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    background:#f8fafc;
    color:#1e293b;
}

/* TOPBAR */
.topbar{
    background:#ffffff;
    border-bottom:1px solid #e2e8f0;
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.logo{
    font-size:24px;
    font-weight:bold;
    color:#2563eb;
}

.user-info{
    font-size:14px;
}

.user{
    color:#2563eb;
    font-weight:bold;
}

/* CONTAINER */
.container{
    max-width:1200px;
    margin:auto;
    padding:40px 20px;
}

/* WELCOME */
.welcome{
    margin-bottom:30px;
}

.welcome h1{
    font-size:30px;
    margin-bottom:5px;
}

.welcome p{
    color:#64748b;
}

/* STAT CARD */
.stats{
    margin-bottom:35px;
}

.stats-card{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:white;
    padding:30px;
    border-radius:20px;
    max-width:300px;
    box-shadow:0 10px 25px rgba(37,99,235,0.25);
}

.stats-card h2{
    font-size:48px;
}

.stats-card p{
    margin-top:5px;
}

/* MENU GRID */
.menu{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.card{
    text-decoration:none;
    background:#ffffff;
    border-radius:18px;
    padding:25px;
    color:#1e293b;
    border:1px solid #e2e8f0;
    box-shadow:0 4px 15px rgba(0,0,0,0.05);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.icon{
    font-size:40px;
    color:#2563eb;
    margin-bottom:15px;
}

.title{
    font-size:18px;
    font-weight:bold;
}

.desc{
    margin-top:8px;
    color:#64748b;
    font-size:14px;
    line-height:1.5;
}

/* FOOTER */
.footer{
    margin-top:40px;
    text-align:center;
    color:#94a3b8;
    font-size:13px;
}
</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">

    <div class="logo">
        🏠 Sistem Kontrakan LBS
    </div>

    <div class="user-info">
        Login sebagai:
        <span class="user">
            <?php echo $_SESSION['username']; ?>
        </span>
    </div>

</div>

<div class="container">

    <!-- WELCOME -->
    <div class="welcome">
        <h1>Dashboard Admin</h1>
        <p>
            Selamat datang di Sistem Informasi Pencarian Kontrakan Berbasis Location Based Service (LBS).
        </p>
    </div>

    <!-- STATISTIK -->
    <div class="stats">
        <div class="stats-card">
            <h2><?php echo $jumlah_kontrakan; ?></h2>
            <p>Total Kontrakan Terdaftar</p>
        </div>
    </div>

    <!-- MENU -->
    <div class="menu">

        <a href="data_kontrakan.php" class="card">
            <div class="icon"><i class="fa-solid fa-table-list"></i></div>
            <div class="title">Data Kontrakan</div>
            <div class="desc">Melihat, mengelola, mengubah, dan menghapus data kontrakan yang tersimpan dalam sistem.</div>
        </a>

        <a href="tambah_kontrakan.php" class="card">
            <div class="icon"><i class="fa-solid fa-plus"></i></div>
            <div class="title">Tambah Data</div>
            <div class="desc">Menambahkan data kontrakan baru beserta lokasi dan informasi pendukung lainnya.</div>
        </a>

        <a href="peta_kontrakan.php" class="card">
            <div class="icon"><i class="fa-solid fa-map-location-dot"></i></div>
            <div class="title">Peta Lokasi</div>
            <div class="desc">Menampilkan lokasi kontrakan berbasis Location Based Service (LBS) pada peta digital.</div>
        </a>

        <a href="logout.php" class="card">
            <div class="icon"><i class="fa-solid fa-right-from-bracket"></i></div>
            <div class="title">Logout</div>
            <div class="desc">Keluar dari sistem administrator dengan aman.</div>
        </a>

    </div>

    <div class="footer"></div>

</div>

</body>
</html>