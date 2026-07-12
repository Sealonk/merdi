<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Data Kontrakan</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f8fafc;
    min-height:100vh;
    padding:40px 20px;
}

.container{
    max-width:850px;
    margin:auto;
    background:#ffffff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 25px rgba(0,0,0,0.08);
}

.header{
    text-align:center;
    margin-bottom:30px;
}

.header h2{
    color:#1e293b;
    margin-bottom:8px;
}

.header p{
    color:#64748b;
    font-size:14px;
}

form{
    display:flex;
    flex-direction:column;
    gap:18px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

label{
    margin-bottom:7px;
    color:#334155;
    font-weight:500;
}

input,
textarea,
select{
    padding:12px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    font-size:14px;
    outline:none;
    transition:0.3s;
}

input:focus,
textarea:focus,
select:focus{
    border-color:#2563eb;
    box-shadow:0 0 8px rgba(37,99,235,0.15);
}

textarea{
    resize:vertical;
}

button{
    background:#2563eb;
    color:white;
    border:none;
    padding:14px;
    border-radius:10px;
    cursor:pointer;
    font-size:15px;
    font-weight:bold;
    transition:0.3s;
}

button:hover{
    background:#1d4ed8;
}

.back{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:#2563eb;
    font-weight:500;
}

.back:hover{
    text-decoration:underline;
}

.footer{
    margin-top:25px;
    text-align:center;
    color:#64748b;
    font-size:13px;
}

</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>➕ Tambah Data Kontrakan</h2>
        <p>Masukkan informasi kontrakan secara lengkap dan benar</p>
    </div>

    <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nama Kontrakan</label>
            <input type="text" name="nama" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" rows="4" required></textarea>
        </div>

<div class="form-group">
    <label>Kecamatan</label>
    <select name="kecamatan" required>
        <option value="">-- Pilih Kecamatan --</option>
        <option value="Bumi Waras">Bumi Waras</option>
        <option value="Enggal">Enggal</option>
        <option value="Kedamaian">Kedamaian</option>
        <option value="Kedaton">Kedaton</option>
        <option value="Kemiling">Kemiling</option>
        <option value="Labuhan Ratu">Labuhan Ratu</option>
        <option value="Langkapura">Langkapura</option>
        <option value="Panjang">Panjang</option>
        <option value="Rajabasa">Rajabasa</option>
        <option value="Sukabumi">Sukabumi</option>
        <option value="Sukarame">Sukarame</option>
        <option value="Tanjung Karang Barat">Tanjung Karang Barat</option>
        <option value="Tanjung Karang Pusat">Tanjung Karang Pusat</option>
        <option value="Tanjung Karang Timur">Tanjung Karang Timur</option>
        <option value="Tanjung Senang">Tanjung Senang</option>
        <option value="Teluk Betung Barat">Teluk Betung Barat</option>
        <option value="Teluk Betung Selatan">Teluk Betung Selatan</option>
        <option value="Teluk Betung Timur">Teluk Betung Timur</option>
        <option value="Teluk Betung Utara">Teluk Betung Utara</option>
        <option value="Way Halim">Way Halim</option>
    </select>
</div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-group">
            <label>Latitude</label>
            <input type="text" name="latitude" required>
        </div>

        <div class="form-group">
            <label>Longitude</label>
            <input type="text" name="longitude" required>
        </div>

        <div class="form-group">
            <label>No HP / WhatsApp</label>
            <input type="text" name="no_hp" placeholder="628xxxxxxxxxx" required>
        </div>

        <div class="form-group">
            <label>Link Google Maps</label>
            <input type="text" name="link_maps" placeholder="https://maps.google.com/..." required>
        </div>

        <div class="form-group">
            <label>Foto Kontrakan</label>
            <input type="file" name="foto" required>
        </div>

        <button type="submit">
            Simpan Data
        </button>

    </form>

    <a href="dashboard.php" class="back">
        ← Kembali ke Dashboard
    </a>

    <div class="footer">
        Sistem Informasi Pencarian Kontrakan Berbasis LBS Kota Bandar Lampung
    </div>

</div>

</body>
</html>