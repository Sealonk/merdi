<?php
session_start();
include 'koneksi.php';

// ambil input
$username = $_POST['username'];
$password = $_POST['password'];

// query cek admin
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

$data = mysqli_fetch_assoc($query);

// kalau login berhasil
if($data){
    $_SESSION['id_admin'] = $data['id_admin'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = 'admin';

    header("Location: dashboard.php");
    exit;
}
else{
    echo "<script>
            alert('Username atau Password Salah!');
            window.location='login.php';
          </script>";
}
?>