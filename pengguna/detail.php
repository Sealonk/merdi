<?php
require_once __DIR__ . '/../koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("ID tidak valid.");
}

$stmt = mysqli_prepare($conn, "SELECT * FROM kontrakan WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data kontrakan tidak ditemukan.");
}

$nama       = htmlspecialchars($data['nama_kontrakan']);
$alamat     = htmlspecialchars($data['alamat']);
$kecamatan  = htmlspecialchars($data['kecamatan']);
$harga      = $data['harga'];
$foto       = $data['foto'];
$latitude   = $data['latitude'];
$longitude  = $data['longitude'];

$deskripsi = isset($data['deskripsi']) && !empty($data['deskripsi'])
    ? htmlspecialchars($data['deskripsi'])
    : "Silakan hubungi pemilik kontrakan melalui WhatsApp untuk informasi lebih lengkap.";

$no_wa = preg_replace('/^0/', '62', $data['no_hp']);

$pesan = urlencode("Halo, saya tertarik dengan kontrakan $nama. Apakah masih tersedia?");

$maps_url = "https://www.google.com/maps?q=$latitude,$longitude";

// Hitung Jarak
$jarak_text = "";
if(isset($_GET['lat']) && isset($_GET['lng']) && !empty($latitude) && !empty($longitude)){
    $user_lat = floatval($_GET['lat']);
    $user_lng = floatval($_GET['lng']);
    
    function haversineDistance($lat1, $lon1, $lat2, $lon2){
        $R = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $R * $c;
    }
    
    $jarak = haversineDistance($user_lat, $user_lng, $latitude, $longitude);
    $jarak_text = round($jarak, 2) . " KM dari lokasi Anda";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $nama ?> | Kontrakan Bandar Lampung</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
body { background:#f5f7fb; color:#1f2937; }
.container { max-width:1100px; margin:auto; padding:30px 20px; }
.box { background:#fff; border-radius:20px; overflow:hidden; box-shadow:0 10px 35px rgba(0,0,0,.08); }
.foto { width:100%; height:420px; object-fit:cover; }
.content { padding:30px; }
.badge { display:inline-block; background:#e0f2fe; color:#0284c7; padding:8px 18px; border-radius:50px; font-size:14px; font-weight:600; margin-bottom:15px; }
.distance-info { background:#dcfce7; color:#166534; padding:12px 20px; border-radius:50px; font-weight:600; margin:15px 0; display:inline-block; }
.title { font-size:32px; font-weight:700; margin-bottom:8px; color:#111827; }
.subtitle { font-size:16px; color:#6b7280; margin-bottom:25px; }
.info-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px; margin:30px 0; }
.info-card { background:#f8fafc; border:1px solid #e5e7eb; border-radius:16px; padding:20px; }
.label { font-size:14px; font-weight:600; color:#6b7280; margin-bottom:8px; display:block; }
.price { font-size:32px; font-weight:700; color:#2563eb; }
.btn-group { margin-top:35px; display:flex; flex-wrap:wrap; gap:15px; }
.btn { flex:1; min-width:220px; padding:16px; border-radius:12px; text-decoration:none; text-align:center; font-weight:600; transition:.3s; }
.wa { background:#16a34a; color:white; }
.maps { background:#2563eb; color:white; }
.back { background:#374151; color:white; }
.btn:hover { transform:translateY(-3px); }
@media(max-width:768px){

.container{

padding:15px;

}

.content{

padding:20px;

}

.title{

font-size:26px;

}

.price{

font-size:24px;

}

.foto{

height:220px;

}

iframe{

height:250px !important;

}

.btn{

min-width:100%;

}

}
</style>
</head>
<body>

<div class="container">
<div class="box">

<?php if(!empty($foto)): ?>
<img src="../uploads/<?= htmlspecialchars($foto) ?>" class="foto" alt="<?= $nama ?>">
<?php endif; ?>

<div class="content">

<div class="badge">📍 Kecamatan <?= $kecamatan ?></div>

<?php if(!empty($jarak_text)): ?>
    <div class="distance-info">📍 <?= $jarak_text ?></div>
<?php endif; ?>

<h1 class="title"><?= $nama ?></h1>
<div class="subtitle">Kontrakan di Bandar Lampung</div>

<div class="info-grid">
    <div class="info-card">
        <span class="label">💰 Harga Sewa</span>
        <div class="price">Rp <?= number_format($harga,0,',','.') ?> <small>/tahun</small></div>
    </div>
    <div class="info-card">
        <span class="label">📍 Alamat</span>
        <?= nl2br($alamat) ?>
    </div>
</div>

<div class="deskripsi" style="margin-top:30px; background:#f9fafb; padding:25px; border-radius:15px; border-left:5px solid #2563eb;">
    <h2 style="margin-bottom:15px;color:#111827;">📝 Deskripsi Kontrakan</h2>
    <p><?= nl2br($deskripsi) ?></p>
</div>

<?php if(!empty($latitude) && !empty($longitude)): ?>
<div style="margin-top:35px;">
    <h2 style="margin-bottom:15px;color:#111827;">🗺️ Lokasi Kontrakan</h2>
    <iframe src="https://maps.google.com/maps?q=<?= $latitude ?>,<?= $longitude ?>&z=16&output=embed" loading="lazy" allowfullscreen style="width:100%; height:380px; border:none; border-radius:15px;"></iframe>
</div>
<?php endif; ?>

<div class="btn-group">
    <?php if(!empty($no_wa)): ?>
    <a href="https://wa.me/<?= $no_wa ?>?text=<?= $pesan ?>" target="_blank" class="btn wa">💬 Hubungi Pemilik via WhatsApp</a>
    <?php endif; ?>

    <?php if(!empty($latitude) && !empty($longitude)): ?>
    <a href="<?= $maps_url ?>" target="_blank" class="btn maps">📍 Buka di Google Maps</a>
    <?php endif; ?>

    <a href="landing.php" class="btn back">← Kembali ke Beranda</a>
</div>

</div>
</div>
</div>

</body>
</html>