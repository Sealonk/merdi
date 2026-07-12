<?php
$conn = mysqli_connect("localhost", "root", "", "lbs_kontrakan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
