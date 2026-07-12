<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontrakan Bandar Lampung - Temukan Rumah Impianmu</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
body { 
    background:linear-gradient(135deg, #0f172a 0%, #1e40af 100%); 
    color:white; min-height:100vh; display:flex; align-items:center; justify-content:center; 
}
.container { text-align:center; max-width:800px; padding:20px; }
.logo { font-size:42px; margin-bottom:30px; }
h1 { font-size:52px; font-weight:800; margin-bottom:20px; line-height:1.1; }
p { font-size:21px; margin-bottom:50px; opacity:0.9; line-height:1.6; }
.btn {
    background:#22c55e; color:white; padding:20px 65px; font-size:21px; 
    font-weight:700; border-radius:50px; text-decoration:none; display:inline-flex; align-items:center; gap:12px;
    box-shadow:0 15px 40px rgba(34,197,94,0.4); transition:0.4s;
}
.btn:hover { background:#16a34a; transform:translateY(-5px); }
.features { margin-top:80px; display:flex; justify-content:center; gap:40px; flex-wrap:wrap; }
.feature { text-align:center; max-width:200px; }
.feature i { font-size:42px; margin-bottom:15px; color:#60a5fa; }
@media (max-width:768px){

.container{
    padding:25px;
}

.logo{
    font-size:32px;
}

h1{
    font-size:32px;
    line-height:1.3;
}

p{
    font-size:16px;
    margin-bottom:35px;
}

.btn{
    width:100%;
    justify-content:center;
    padding:16px;
    font-size:18px;
}

.features{
    gap:20px;
    margin-top:50px;
}

.feature{
    max-width:150px;
}

.feature i{
    font-size:32px;
}

}
</style>
</head>
<body>

<div class="container">
    <div class="logo">🏠 Kontrakan Lampung</div>
    <h1>Temukan Tempat Tinggal Impianmu di Bandar Lampung</h1>
    <p>Sistem pencarian kontrakan berbasis lokasi GPS yang membantu kamu menemukan rumah atau kamar kost terbaik dengan cepat dan mudah.</p>
    
   <div style="display:flex;justify-content:center;gap:20px;flex-wrap:wrap;">

    <a href="dashboard.php" class="btn">
        <i class="fas fa-search-location"></i>
        Cari Kontrakan
    </a>

    <a href="kecamatan.php" class="btn" style="background:#2563eb;">
        <i class="fas fa-map-marker-alt"></i>
        Cari Berdasarkan Kecamatan
    </a>

</div>

    <div class="features">
        <div class="feature">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Lokasi GPS</h3>
        </div>
        <div class="feature">
            <i class="fas fa-handshake"></i>
            <h3>Langsung Hubungi</h3>
        </div>
        <div class="feature">
            <i class="fas fa-shield-alt"></i>
            <h3>Aman & Terpercaya</h3>
        </div>
    </div>
</div>

</body>
</html>