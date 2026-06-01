<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

include 'config/koneksi.php';

$profil = mysqli_fetch_array(
mysqli_query($conn,"
SELECT * FROM profil_admin
LIMIT 1
")
);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pengaturan ERP AI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fb;
font-family:Arial;
}

.sidebar{
width:260px;
height:100vh;
background:#071c3f;
position:fixed;
padding:25px;
}

.sidebar h2{
color:white;
margin-bottom:40px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:14px;
border-radius:12px;
margin-bottom:10px;
}

.sidebar a:hover{
background:#0d6efd;
}

.content{
margin-left:280px;
padding:35px;
}

.card-box{
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 3px 10px rgba(0,0,0,.05);
margin-bottom:25px;
}

.title{
font-size:35px;
font-weight:bold;
margin-bottom:25px;
}

.info{
font-size:18px;
margin-bottom:12px;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>☕ CircleCoffe</h2>

<a href="index.php">🏠 Dashboard</a>
<a href="transaksi.php">💳 Transaksi</a>
<a href="mutasi_bank.php">🏦 Mutasi Bank</a>
<a href="rekonsiliasi.php">🤖 Rekonsiliasi AI</a>
<a href="laporan.php">📊 Laporan</a>
<a href="pengaturan.php">⚙️ Pengaturan</a>
<a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

<div class="title">
⚙️ Pengaturan Sistem
</div>

<div class="card-box">

<h3 class="mb-4">
👤 Profil Admin
</h3>

<div class="info">
<b>Nama :</b>
<?= $profil['nama_lengkap']; ?>
</div>

<div class="info">
<b>Username :</b>
<?= $profil['username']; ?>
</div>

<div class="info">
<b>Role :</b>
<?= $profil['role']; ?>
</div>

</div>

<div class="card-box">

<h3 class="mb-4">
📊 Informasi Sistem
</h3>

<ul>

<li>ERP Cloud AI Versi 1.0</li>

<li>PHP & MySQL</li>

<li>Bootstrap 5</li>

<li>Automated Financial Reconciliation</li>

<li>Machine Learning Simulation</li>

</ul>

</div>

<div class="card-box">

<h3 class="mb-4">
🔒 Keamanan Sistem
</h3>

<a href="ganti_password.php"
class="btn btn-primary">

Ganti Password

</a>

</div>

</div>

</body>
</html>