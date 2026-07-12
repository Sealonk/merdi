<?php
require_once __DIR__ . '/../koneksi.php';

// ==============================
// Ambil Lokasi User
// ==============================
$user_lat = isset($_GET['lat']) ? (float)$_GET['lat'] : 0;
$user_lng = isset($_GET['lng']) ? (float)$_GET['lng'] : 0;

// ==============================
// Filter
// ==============================
$kecamatan = $_GET['kecamatan'] ?? '';
$min_harga = isset($_GET['min_harga']) ? (int)$_GET['min_harga'] : 0;

// ==============================
// Rumus Haversine
// ==============================
function hitungJarak($lat1, $lon1, $lat2, $lon2){

    $earth = 6371;

    $dLat = deg2rad($lat2-$lat1);
    $dLon = deg2rad($lon2-$lon1);

    $a =
        sin($dLat/2)*sin($dLat/2)+
        cos(deg2rad($lat1))*
        cos(deg2rad($lat2))*
        sin($dLon/2)*
        sin($dLon/2);

    $c = 2*atan2(sqrt($a),sqrt(1-$a));

    return $earth*$c;
}

// ==============================
// Query Database
// ==============================

$sql = "SELECT * FROM kontrakan WHERE 1=1";

if($kecamatan != ""){
    $sql .= " AND kecamatan='$kecamatan'";
}

if($min_harga > 0){
    $sql .= " AND harga >= '$min_harga'";
}

$query = mysqli_query($conn,$sql);

$dataKontrakan = [];

while($row=mysqli_fetch_assoc($query)){

    if(
        $user_lat != 0 &&
        $user_lng != 0 &&
        $row['latitude'] != "" &&
        $row['longitude'] != ""
    ){

        $row['jarak']=hitungJarak(
            $user_lat,
            $user_lng,
            (float)$row['latitude'],
            (float)$row['longitude']
        );

    }else{

        $row['jarak']=999999;

    }

    $dataKontrakan[]=$row;

}

// ==============================
// Urutkan berdasarkan jarak
// ==============================

// Urutkan berdasarkan jarak
usort($dataKontrakan, function($a, $b){
    return $a['jarak'] <=> $b['jarak'];
});

// Jika lokasi user tersedia
if($user_lat != 0 && $user_lng != 0 && count($dataKontrakan) > 0){

    // Kecamatan dari kontrakan yang paling dekat
    $kecamatanTerdekat = $dataKontrakan[0]['kecamatan'];

    // Ambil hanya kontrakan di kecamatan tersebut
    $hasilFilter = [];

    foreach($dataKontrakan as $item){

        if(strtolower(trim($item['kecamatan'])) == strtolower(trim($kecamatanTerdekat))){
            $hasilFilter[] = $item;
        }

    }

    // Ganti data lama
    $dataKontrakan = $hasilFilter;

    // Urutkan lagi
    usort($dataKontrakan, function($a, $b){
        return $a['jarak'] <=> $b['jarak'];
    });

}
?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Kontrakan</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter',sans-serif;
}

body{
    background:#f5f7fb;
}

/* ================= NAVBAR ================= */

nav{

    background:white;

    padding:18px 7%;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 5px 18px rgba(0,0,0,.08);

    position:sticky;

    top:0;

    z-index:999;

}

.logo{

    font-size:24px;

    font-weight:bold;

    color:#2563eb;

}

.menu{

    display:flex;

    gap:20px;

}

.menu a{

    text-decoration:none;

    color:#374151;

    font-weight:600;

}

.menu a:hover{

    color:#2563eb;

}

/* ================= HEADER ================= */

.header{

    background:linear-gradient(135deg,#2563eb,#1d4ed8);

    color:white;

    text-align:center;

    padding:70px 20px;

}

.header h1{

    font-size:36px;

    margin-bottom:10px;

}

.header p{

    opacity:.9;

}

/* ================= FILTER ================= */

.search{

    background:white;

    max-width:1200px;

    margin:-35px auto 35px;

    padding:20px;

    border-radius:15px;

    box-shadow:0 8px 25px rgba(0,0,0,.08);

}

.search form{

    display:flex;

    flex-wrap:wrap;

    gap:15px;

}

.search input,
.search select{

    flex:1;

    min-width:180px;

    padding:12px;

    border:1px solid #ddd;

    border-radius:10px;

    font-size:15px;

}

.search button{

    background:#2563eb;

    color:white;

    border:none;

    padding:12px 30px;

    border-radius:10px;

    cursor:pointer;

    font-weight:bold;

}

.search button:hover{

    background:#1e40af;

}

/* ================= CARD ================= */

.container{

    max-width:1200px;

    margin:auto;

    padding:25px;

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));

    gap:25px;

}

.card{

    background:white;

    border-radius:18px;

    overflow:hidden;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    transition:.3s;

}

.card:hover{

    transform:translateY(-8px);

}

.card img{

    width:100%;

    height:210px;

    object-fit:cover;

}

.content{

    padding:20px;

}

.badge{

    display:inline-block;

    background:#e0f2fe;

    color:#2563eb;

    padding:6px 15px;

    border-radius:30px;

    font-size:13px;

    font-weight:600;

}

.distance{

    margin-top:12px;

    color:#0f766e;

    font-size:14px;

    font-weight:600;

}

.title{

    margin-top:10px;

    font-size:22px;

    font-weight:bold;

}

.price{

    margin-top:8px;

    color:#16a34a;

    font-size:24px;

    font-weight:bold;

}

.btn{

    display:block;

    margin-top:18px;

    text-align:center;

    text-decoration:none;

    background:#2563eb;

    color:white;

    padding:13px;

    border-radius:10px;

    font-weight:bold;

}

.btn:hover{

    background:#1d4ed8;

}

</style>

</head>

<body>

<nav>

<div class="logo">
🏠 Kontrakan Lampung
</div>

<div class="menu">

<a href="landing.php">Beranda</a>

<a href="#" onclick="ambilLokasi()">Terdekat</a>

<a href="kecamatan.php">Kecamatan</a>

</div>

</nav>

<div class="header">

<h1>Kontrakan Terdekat</h1>

<p>Cari kontrakan berdasarkan lokasi Anda</p>

</div>

<div class="search">

<form method="GET">

<input type="hidden" name="lat" value="<?= $user_lat ?>">

<input type="hidden" name="lng" value="<?= $user_lng ?>">

<select name="kecamatan">

<option value="">Semua Kecamatan</option>

<?php
$daftarKecamatan = [
    "Bumi Waras",
    "Enggal",
    "Kedamaian",
    "Kedaton",
    "Kemiling",
    "Labuhan Ratu",
    "Langkapura",
    "Panjang",
    "Rajabasa",
    "Sukabumi",
    "Sukarame",
    "Tanjung Karang Barat",
    "Tanjung Karang Pusat",
    "Tanjung Karang Timur",
    "Tanjung Senang",
    "Teluk Betung Barat",
    "Teluk Betung Selatan",
    "Teluk Betung Timur",
    "Teluk Betung Utara",
    "Way Halim"
];

foreach ($daftarKecamatan as $kec) {
    $selected = ($kecamatan == $kec) ? "selected" : "";
    echo "<option value='$kec' $selected>$kec</option>";
}
?>

</select>

<input
type="number"
name="min_harga"
placeholder="Harga Minimal"
value="<?= $min_harga ?>">

<button>Cari</button>

</form>

</div>

<div style="
max-width:1200px;
margin:20px auto;
padding:15px 20px;
background:#eff6ff;
border-left:5px solid #2563eb;
border-radius:10px;
font-weight:600;
color:#1e3a8a;">
📍 Ditemukan <b><?= count($dataKontrakan) ?></b> kontrakan terdekat.
</div>
<div class="container">
    <?php if(count($dataKontrakan)>0): ?>

<?php foreach($dataKontrakan as $index => $data): ?>

<div class="card">

    <?php if(!empty($data['foto'])): ?>

        <img src="https://storage.googleapis.com/kontrakan_merdi/<?= htmlspecialchars($data['foto']) ?>">

    <?php else: ?>

        <img src="https://via.placeholder.com/400x250?text=Tidak+Ada+Foto">

    <?php endif; ?>

    <div class="content">
<?php if($index == 0): ?>
<div style="
background:#facc15;
color:#111827;
padding:6px 12px;
border-radius:20px;
display:inline-block;
font-size:12px;
font-weight:bold;
margin-bottom:10px;">
⭐ PALING DEKAT
</div>
<?php endif; ?>
        <span class="badge">

            <?= htmlspecialchars($data['kecamatan']) ?>

        </span>

        <?php if($data['jarak'] != 999999): ?>

        <div class="distance">

            <i class="fas fa-location-dot"></i>

            <?php

            if($data['jarak'] < 1){

                echo round($data['jarak']*1000)." Meter dari lokasi Anda";

            }else{

                echo number_format($data['jarak'],2)." KM dari lokasi Anda";

            }

            ?>

        </div>

        <?php endif; ?>

        <div class="title">

            <?= htmlspecialchars($data['nama_kontrakan']) ?>

        </div>

        <div class="price">

            Rp <?= number_format($data['harga'],0,',','.') ?>/tahun

        </div>

        <a

        href="detail.php?id=<?= $data['id'] ?>"

        class="btn">

        Lihat Detail

        </a>

    </div>

</div>

<?php endforeach; ?>

<?php else: ?>

<h2 style="text-align:center;width:100%;">

Data tidak ditemukan

</h2>

<?php endif; ?>

</div>

<script>

function ambilLokasi(){

    if(navigator.geolocation){

        navigator.geolocation.getCurrentPosition(function(pos){

            let lat=pos.coords.latitude;

            let lng=pos.coords.longitude;

            let url=new URL(window.location.href);

            url.searchParams.set("lat",lat);

            url.searchParams.set("lng",lng);

            window.location=url;

        },function(){

            alert("Izinkan akses lokasi terlebih dahulu.");

        });

    }

}

// otomatis saat halaman dibuka
window.onload=function(){

    let url=new URL(window.location.href);

    if(!url.searchParams.has("lat")){

        ambilLokasi();

    }

}

</script>

</body>

</html>