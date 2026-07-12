<?php
include 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM kontrakan");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pencarian Kontrakan Bandar Lampung</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f1f5f9;
}

.header{
    background:#0f172a;
    color:white;
    padding:25px;
    text-align:center;
}

.container{
    max-width:1200px;
    margin:auto;
    padding:30px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:20px;
}

.card{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card img{
    width:100%;
    height:250px;
    object-fit:contain;
    background:#f1f5f9;
    padding:10px;
    border-bottom:1px solid #e2e8f0;
    display:block;
}

.content{
    padding:15px;
}

.nama{
    font-size:22px;
    font-weight:bold;
    margin-bottom:10px;
}

.harga{
    color:#2563eb;
    font-weight:bold;
    margin-bottom:10px;
}

.alamat{
    color:#475569;
    margin-bottom:10px;
}

.fasilitas{
    margin-bottom:10px;
}

.btn{
    display:inline-block;
    padding:10px 15px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:8px;
}

</style>
</head>
<body>

<div class="header">
    <h1>🏠 Sistem Informasi Pencarian Kontrakan</h1>
    <p>Kota Bandar Lampung</p>
</div>

<div class="container">

<div class="grid">

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<div class="card">

<img src="https://storage.googleapis.com/kontrakan_merdi/<?php echo $row['foto']; ?>">

<div class="content">

<div class="nama">
    <?php echo $row['nama']; ?>
</div>

<div class="harga">
    Rp <?php echo number_format($row['harga']); ?> / Tahun
</div>

<div class="alamat">
    📍 <?php echo $row['alamat']; ?>
</div>

<div class="fasilitas">
    🛏️ <?php echo $row['fasilitas']; ?>
</div>

<a class="btn"
href="https://www.google.com/maps?q=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>"
target="_blank">
Lihat Lokasi
</a>

</div>
</div>

<?php } ?>

</div>

</div>

</body>
</html>