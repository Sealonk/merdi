<?php
include 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM kontrakan");

if(!$data){
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peta Kontrakan</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <style>
        #map{
            height: 600px;
            width: 100%;
        }

        body{
            font-family: Arial, sans-serif;
            margin:20px;
        }

        img{
            border-radius:5px;
        }
    </style>
</head>
<body>

<h2>Peta Lokasi Kontrakan</h2>

<div id="map"></div>

<br>

<a href="dashboard.php">← Kembali ke Dashboard</a>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([-5.429, 105.261], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

</script>

<?php while($row = mysqli_fetch_assoc($data)){ 
    if(!empty($row['latitude']) && !empty($row['longitude'])) {
?>

<script>

L.marker([<?= $row['latitude']; ?>, <?= $row['longitude']; ?>])
.addTo(map)
.bindPopup(`
    <center>
        <img src="foto/<?= $row['foto'] ?? 'default.jpg'; ?>" width="120"><br><br>

        <b><?= $row['nama_kontrakan'] ?? '-' ?></b><br>

        <?= $row['alamat'] ?? '-' ?><br><br>

        Harga: Rp <?= number_format($row['harga'] ?? 0,0,',','.') ?>
    </center>
`);

</script>

<?php } } ?>

</body>
</html>