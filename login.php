<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users 
    WHERE email='$email' 
    AND password='$password'");

    $cek = mysqli_num_rows($query);

    if($cek > 0){

        $_SESSION['login'] = true;

        header("Location: index.php");

    }
    else{

        $error = "Email atau Password Salah!";

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login ERP AI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#071c3f;
    font-family:Arial, Helvetica, sans-serif;
}

.login-box{
    background:white;
    border-radius:25px;
    padding:45px;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

.title{
    font-size:38px;
    font-weight:bold;
    margin-bottom:10px;
}

.subtitle{
    color:gray;
    margin-bottom:30px;
}

.form-control{
    height:50px;
    border-radius:12px;
}

.btn-primary{
    height:50px;
    border-radius:12px;
    font-size:16px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center align-items-center vh-100">

<div class="col-md-5">

<div class="login-box">

<div class="title">
☕ Circle coffe
</div>

<div class="subtitle">
Silahkan Login 
</div>

<?php if(isset($error)){ ?>

<div class="alert alert-danger">
    <?= $error; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="mb-2">
Email
</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-4">

<label class="mb-2">
Password
</label>

<input type="password"
name="password"
class="form-control"
required>

</div>

<button type="submit"
name="login"
class="btn btn-primary w-100">

Login

</button>

</form>

</div>

</div>

</div>

</div>

</body>
</html>
