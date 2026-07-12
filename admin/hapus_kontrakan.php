<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM kontrakan WHERE id='$id'");

header("Location: data_kontrakan.php");
exit;
?>