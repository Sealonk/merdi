<?php
include "koneksi.php";

// ambil data kontrakan
$data = mysqli_query($conn, "SELECT * FROM kontrakan");

if(!$data){
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peta Kontrakan Bandar Lampung</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        #map {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>

<body>

<div id="map"></div>

<script>
    // fokus awal Bandar Lampung
    var map = L.map('map').setView([-5.4294, 105.2625], 13);

    // OpenStreetMap layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
</script>

<?php while ($row = mysqli_fetch_assoc($data)) { 
    if(!empty($row['latitude']) && !empty($row['longitude'])) {
?>

<script>
    L.marker([<?= $row['latitude']; ?>, <?= $row['longitude']; ?>])
        .addTo(map)
        .bindPopup(`
            <b><?= $row['nama_kontrakan'] ?? '-' ?></b><br>
            <?= $row['alamat'] ?? '-' ?><br>
            Harga: Rp <?= number_format($row['harga'] ?? 0,0,',','.') ?>
        );
</script>

<?php 
    }
} 
?>

</body>
</html>