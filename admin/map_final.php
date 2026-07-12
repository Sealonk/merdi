<?php
include "koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM kontrakan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peta Kontrakan Berbasis LBS</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #map {
            width: 100vw;
            height: 100vh;
        }
        .info {
            position: absolute;
            top: 10px;
            left: 10px;
            background: white;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            z-index: 999;
        }
    </style>
</head>
<body>

<div class="info">
    <b>Sistem Informasi Kontrakan LBS</b><br>
    Kota Bandar Lampung
</div>

<div id="map"></div>

<script>
    var map = L.map('map').setView([-2.9909, 104.7566], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        L.marker([<?= $row['latitude']; ?>, <?= $row['longitude']; ?>])
        .addTo(map)
        .bindPopup(`
            <b><?= $row['nama']; ?></b><br>
            <?= $row['alamat']; ?><br>
            Harga: Rp <?= number_format($row['harga']); ?>
        `);
    <?php } ?>

    // Lokasi user (LBS)
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            var lat = pos.coords.latitude;
            var lng = pos.coords.longitude;

            L.marker([lat, lng])
                .addTo(map)
                .bindPopup("<b>Lokasi Anda</b>")
                .openPopup();

            map.setView([lat, lng], 14);
        });
    }
</script>

</body>
</html>
