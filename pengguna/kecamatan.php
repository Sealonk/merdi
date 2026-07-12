<?php
require_once __DIR__ . '/../koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kontrakan per Kecamatan - Kontrakan BL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #222;
        }
        nav {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 8%;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo { 
            font-size: 26px; 
            font-weight: 700; 
            color: #111827; 
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }
        h1 { 
            text-align: center; 
            margin-bottom: 50px; 
            color: #111827;
            font-size: 32px;
        }
        .kecamatan-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .kec-card {
            background: white;
            border-radius: 16px;
            padding: 35px 25px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .kec-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }
        .kec-card h3 {
            color: #2563eb;
            margin-bottom: 20px;
            font-size: 23px;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 32px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }
        .footer {
            text-align: center;
            padding: 40px;
            color: #777;
            font-size: 14px;
            margin-top: 60px;
        }
        @media(max-width:768px){

nav{

flex-direction:column;

padding:15px;

gap:15px;

}

.container{

margin:30px auto;

padding:15px;

}

h1{

font-size:26px;

}

.kecamatan-list{

grid-template-columns:1fr;

}

.kec-card{

padding:25px;

}

.btn{

width:100%;

}

}
    </style>
</head>
<body>

    <nav>
        <div class="logo">Kontrakan BL</div>
        <div>
            <a href="landing.php" style="margin-right:15px;">Beranda</a>
            <a href="dashboard.php?all=1">Semua Kontrakan</a>
        </div>
    </nav>

    <div class="kecamatan-list">

    <div class="kec-card">
        <h3>Bumi Waras</h3>
        <a href="dashboard.php?kecamatan=Bumi Waras" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Enggal</h3>
        <a href="dashboard.php?kecamatan=Enggal" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Kedamaian</h3>
        <a href="dashboard.php?kecamatan=Kedamaian" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Kedaton</h3>
        <a href="dashboard.php?kecamatan=Kedaton" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Kemiling</h3>
        <a href="dashboard.php?kecamatan=Kemiling" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Labuhan Ratu</h3>
        <a href="dashboard.php?kecamatan=Labuhan Ratu" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Langkapura</h3>
        <a href="dashboard.php?kecamatan=Langkapura" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Panjang</h3>
        <a href="dashboard.php?kecamatan=Panjang" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Rajabasa</h3>
        <a href="dashboard.php?kecamatan=Rajabasa" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Sukabumi</h3>
        <a href="dashboard.php?kecamatan=Sukabumi" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Sukarame</h3>
        <a href="dashboard.php?kecamatan=Sukarame" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Tanjung Karang Barat</h3>
        <a href="dashboard.php?kecamatan=Tanjung Karang Barat" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Tanjung Karang Pusat</h3>
        <a href="dashboard.php?kecamatan=Tanjung Karang Pusat" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Tanjung Karang Timur</h3>
        <a href="dashboard.php?kecamatan=Tanjung Karang Timur" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Tanjung Senang</h3>
        <a href="dashboard.php?kecamatan=Tanjung Senang" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Teluk Betung Barat</h3>
        <a href="dashboard.php?kecamatan=Teluk Betung Barat" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Teluk Betung Selatan</h3>
        <a href="dashboard.php?kecamatan=Teluk Betung Selatan" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Teluk Betung Timur</h3>
        <a href="dashboard.php?kecamatan=Teluk Betung Timur" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Teluk Betung Utara</h3>
        <a href="dashboard.php?kecamatan=Teluk Betung Utara" class="btn">Lihat Kontrakan</a>
    </div>

    <div class="kec-card">
        <h3>Way Halim</h3>
        <a href="dashboard.php?kecamatan=Way Halim" class="btn">Lihat Kontrakan</a>
    </div>

</div>

</body>
</html>