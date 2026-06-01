<?php

include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"
DELETE FROM mutasi_bank
WHERE id='$id'
");

header("Location: ../mutasi_bank.php");