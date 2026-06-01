<?php
// Mengambil variabel database dari lingkungan Railway secara aman
$host     = getenv('MYSQLHOST');
$user     = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$database = getenv('MYSQLDATABASE');
$port     = getenv('MYSQLPORT');

// Melakukan koneksi ke database beserta port-nya
$koneksi = mysqli_connect($host, $user, $password, $database, $port);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>