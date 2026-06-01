<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "cafe_erp"
);

if(!$conn){

    die("Koneksi Database Gagal");

}

?>