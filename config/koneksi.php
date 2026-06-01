<?php
// Kode cerdas: Otomatis mendeteksi Railway (Cloud) atau XAMPP (Lokal)
$host = getenv('MYSQLHOST') ?: 'localhost';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: ''; // Kosongkan jika XAMPP lokalmu tanpa password
$db   = getenv('MYSQLDATABASE') ?: 'cafe_cloud_erp'; // Ganti 'cafe_cloud_erp' sesuai nama DB lokalmu di phpMyAdmin
$port = getenv('MYSQLPORT') ?: '3306';

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>