<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM kontrakan WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(!$row){
    die("Data tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Kontrakan</title>

<style>
/* 🔥 INI 100% SAMA PUNYA KAMU (TIDAK DIUBAH SAMA SEKALI) */

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
textarea{
    padding:12px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    font-size:14px;
    outline:none;
    transition:0.3s;
}

input:focus,
textarea:focus{
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
        <h2>✏️ Edit Data Kontrakan</h2>
        <p>Perbarui informasi kontrakan yang telah tersimpan</p>
    </div>

    <form action="update_kontrakan.php" method="POST">

        <input type="hidden" name="id" value="<?= $row['id']; ?>">

        <div class="form-group">
            <label>Nama Kontrakan</label>
            <input type="text" name="nama_kontrakan" value="<?= $row['nama_kontrakan'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" rows="4" required><?= $row['alamat'] ?? ''; ?></textarea>
        </div>


        <div class="form-group">
            <label>Kecamatan</label>
            <select name="kecamatan" required>
<?php
$kecamatan_list = [
"Bumi Waras","Enggal","Kedamaian","Kedaton","Kemiling","Labuhan Ratu",
"Langkapura","Panjang","Rajabasa","Sukabumi","Sukarame",
"Tanjung Karang Barat","Tanjung Karang Pusat","Tanjung Karang Timur",
"Tanjung Senang","Teluk Betung Barat","Teluk Betung Selatan",
"Teluk Betung Timur","Teluk Betung Utara","Way Halim"
];
foreach($kecamatan_list as $kecamatan){
    $selected = ($row['kecamatan']==$kecamatan) ? "selected" : "";
    echo "<option value='$kecamatan' $selected>$kecamatan</option>";
}
?>
            </select>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $row['harga'] ?? 0; ?>" required>
        </div>

        <div class="form-group">
            <label>Latitude</label>
            <input type="text" name="latitude" value="<?= $row['latitude'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label>Longitude</label>
            <input type="text" name="longitude" value="<?= $row['longitude'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" value="<?= $row['no_hp'] ?? ''; ?>" required>
        </div>

        <button type="submit">Update Data</button>

    </form>

    <a href="data_kontrakan.php" class="back">
        ← Kembali ke Data Kontrakan
    </a>

    <div class="footer">
        Sistem Informasi Pencarian Kontrakan Berbasis LBS Kota Bandar Lampung
    </div>

</div>

</body>
</html>