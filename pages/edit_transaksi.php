<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM transaksi_kasir WHERE id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $no_transaksi = $_POST['no_transaksi'];
    $metode = $_POST['metode'];
    $total = $_POST['total'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE transaksi_kasir SET
        no_transaksi='$no_transaksi',
        metode='$metode',
        total='$total',
        status='$status'
        WHERE id='$id'
    ");

    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Transaksi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    font-family:Arial;
}

.card-form{
    border:none;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card card-form shadow">

<div class="card-body p-5">

<h2 class="mb-4">
    Edit Transaksi
</h2>

<form method="POST">

<div class="mb-3">

<label>No Transaksi</label>

<input type="text"
name="no_transaksi"
class="form-control"
value="<?= $d['no_transaksi']; ?>">

</div>

<div class="mb-3">

<label>Metode</label>

<select name="metode"
class="form-control">

<option <?= $d['metode'] == 'QRIS' ? 'selected' : ''; ?>>
QRIS
</option>

<option <?= $d['metode'] == 'Transfer Bank' ? 'selected' : ''; ?>>
Transfer Bank
</option>

<option <?= $d['metode'] == 'Cash' ? 'selected' : ''; ?>>
Cash
</option>

</select>

</div>

<div class="mb-3">

<label>Total</label>

<input type="number"
name="total"
class="form-control"
value="<?= $d['total']; ?>">

</div>

<div class="mb-4">

<label>Status</label>

<select name="status"
class="form-control">

<option <?= $d['status'] == 'Matched' ? 'selected' : ''; ?>>
Matched
</option>

<option <?= $d['status'] == 'Belum Cocok' ? 'selected' : ''; ?>>
Belum Cocok
</option>

<option <?= $d['status'] == 'Mencurigakan' ? 'selected' : ''; ?>>
Mencurigakan
</option>

</select>

</div>

<button type="submit"
name="update"
class="btn btn-primary">

Update Data

</button>

<a href="../index.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>

