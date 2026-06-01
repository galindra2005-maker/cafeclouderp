<?php
include '../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama_bank = $_POST['nama_bank'];
    $no_referensi = $_POST['no_referensi'];
    $total = $_POST['total'];
    $tanggal = $_POST['tanggal'];

    mysqli_query($conn, "
    INSERT INTO mutasi_bank
    VALUES(
        '',
        '$nama_bank',
        '$no_referensi',
        '$total',
        '$tanggal'
    )
    ");

    header("Location: ../mutasi_bank.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Mutasi Bank</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
}

.card{
    border:none;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body p-5">

            <h2 class="mb-4">
                Tambah Mutasi Bank
            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label>Nama Bank</label>

                    <input type="text"
                    name="nama_bank"
                    class="form-control"
                    required>

                </div>

                <div class="mb-3">

                    <label>No Referensi</label>

                    <input type="text"
                    name="no_referensi"
                    class="form-control"
                    required>

                </div>

                <div class="mb-3">

                    <label>Total</label>

                    <input type="number"
                    name="total"
                    class="form-control"
                    required>

                </div>

                <div class="mb-4">

                    <label>Tanggal</label>

                    <input type="date"
                    name="tanggal"
                    class="form-control"
                    required>

                </div>

                <button type="submit"
                name="simpan"
                class="btn btn-primary">

                    Simpan Mutasi

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