<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

include 'config/koneksi.php';

$pesan = "";

if(isset($_POST['simpan'])){

    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi'];

    $user = mysqli_fetch_array(
        mysqli_query($conn,"
        SELECT * FROM users
        LIMIT 1
        ")
    );

    if($user['password'] != $password_lama){

        $pesan = "
        <div class='alert alert-danger'>
        Password lama salah!
        </div>
        ";

    }elseif($password_baru != $konfirmasi){

        $pesan = "
        <div class='alert alert-warning'>
        Konfirmasi password tidak cocok!
        </div>
        ";

    }else{

        mysqli_query($conn,"
        UPDATE users
        SET password='$password_baru'
        WHERE id='$user[id]'
        ");

        $pesan = "
        <div class='alert alert-success'>
        Password berhasil diubah.
        </div>
        ";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ganti Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fb;
font-family:Arial;
}

.card-box{
background:white;
padding:30px;
border-radius:20px;
box-shadow:0 3px 10px rgba(0,0,0,.05);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card-box">

<h2 class="mb-4">
🔒 Ganti Password
</h2>

<?= $pesan; ?>

<form method="POST">

<div class="mb-3">

<label>Password Lama</label>

<input
type="password"
name="password_lama"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password Baru</label>

<input
type="password"
name="password_baru"
class="form-control"
required>

</div>

<div class="mb-4">

<label>Konfirmasi Password Baru</label>

<input
type="password"
name="konfirmasi"
class="form-control"
required>

</div>

<button
type="submit"
name="simpan"
class="btn btn-primary">

Simpan Password

</button>

<a href="pengaturan.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

</body>
</html>