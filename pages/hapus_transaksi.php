
<?php
include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM transaksi_kasir WHERE id='$id'");

header("Location: ../index.php");
?>

 