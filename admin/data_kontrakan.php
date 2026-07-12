<?php
session_start();
include 'koneksi.php';

// =====================
// SECURITY CHECK ADMIN
// =====================
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

// =====================
// QUERY
// =====================
$query = mysqli_query($conn, "SELECT * FROM kontrakan");

if(!$query){
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Kontrakan</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f8fafc;
    padding:30px;
    color:#1e293b;
}

.container{
    max-width:1300px;
    margin:auto;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.back-btn{
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    font-size:14px;
}

.back-btn:hover{
    background:#1d4ed8;
}

/* TABLE */
.table-wrapper{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#2563eb;
    color:white;
    padding:14px;
}

td{
    padding:12px;
    border-bottom:1px solid #e2e8f0;
    text-align:center;
}

tr:hover{
    background:#f1f5f9;
}

/* BUTTON */
.btn{
    text-decoration:none;
    padding:7px 12px;
    border-radius:7px;
    color:white;
    font-size:13px;
    display:inline-block;
    margin:2px;
}

.map{ background:#2563eb; }
.edit{ background:#f59e0b; }
.delete{ background:#ef4444; }

.map:hover{ background:#1d4ed8; }
.edit:hover{ background:#d97706; }
.delete:hover{ background:#dc2626; }

.footer{
    margin-top:20px;
    text-align:center;
    color:#64748b;
    font-size:13px;
}

</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>📋 Data Kontrakan</h2>

        <a href="dashboard.php" class="back-btn">
            ← Dashboard
        </a>
    </div>

    <div class="table-wrapper">

        <table>

            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Harga</th>
                <th>No HP</th>
                <th>Maps</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
            ?>

            <tr>
                <td><?= $no++; ?></td>

                <td><?= $row['nama_kontrakan'] ?? '-' ?></td>

                <td><?= $row['alamat'] ?? '-' ?></td>

                <td>Rp <?= number_format($row['harga'] ?? 0,0,',','.') ?></td>

                <td><?= $row['no_hp'] ?? '-' ?></td>

                <td>
                    <?php if(!empty($row['latitude']) && !empty($row['longitude'])) { ?>
                        <a href="https://www.google.com/maps?q=<?= $row['latitude'] ?>,<?= $row['longitude'] ?>" 
                           target="_blank" 
                           class="btn map">
                           🗺️ Maps
                        </a>
                    <?php } else { ?>
                        -
                    <?php } ?>
                </td>

                <td>
                    <a href="edit_kontrakan.php?id=<?= $row['id']; ?>" class="btn edit">Edit</a>

                    <a href="hapus_kontrakan.php?id=<?= $row['id']; ?>" 
                       class="btn delete"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                       Hapus
                    </a>
                </td>

            </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='7'>Data tidak tersedia</td></tr>";
            }
            ?>

        </table>

    </div>

    <div class="footer">
    </div>

</div>

</body>
</html>