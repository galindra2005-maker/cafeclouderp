<?php

include '../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_array(mysqli_query($conn,"
SELECT * FROM mutasi_bank
WHERE id='$id'
"));

if(isset($_POST['update'])){

    mysqli_query($conn,"
    UPDATE mutasi_bank SET

    nama_bank='$_POST[nama_bank]',
    no_referensi='$_POST[no_referensi]',
    total='$_POST[total]',
    tanggal='$_POST[tanggal]'

    WHERE id='$id'
    ");

    header("Location: ../mutasi_bank.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Mutasi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body p-5">

<h2>Edit Mutasi Bank</h2>

<form method="POST">

<div class="mb-3">

<label>Nama Bank</label>

<input type="text"
name="nama_bank"
class="form-control"
value="<?= $data['nama_bank']; ?>"
required>

</div>

<div class="mb-3">

<label>No Referensi</label>

<input type="text"
name="no_referensi"
class="form-control"
value="<?= $data['no_referensi']; ?>"
required>

</div>

<div class="mb-3">

<label>Total</label>

<input type="number"
name="total"
class="form-control"
value="<?= $data['total']; ?>"
required>

</div>

<div class="mb-4">

<label>Tanggal</label>

<input type="date"
name="tanggal"
class="form-control"
value="<?= $data['tanggal']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-primary">

Update Data

</button>

<a href="../mutasi_bank.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>
</div>
</div>

</body>
</html>