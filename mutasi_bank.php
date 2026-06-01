<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

include 'config/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mutasi Bank</title>

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
    border-radius:20px;
    padding:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.title{
    font-size:35px;
    font-weight:bold;
    margin-bottom:25px;
}

.btn{
    border-radius:10px;
}

.table th{
    background:#f8f9fa;
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
        Data Mutasi Bank
    </div>

    <div class="card-box">

        <div class="d-flex justify-content-end mb-4">

            <a href="pages/tambah_mutasi.php"
            class="btn btn-primary">

                + Tambah Mutasi

            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama Bank</th>
                        <th>No Referensi</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $query = mysqli_query($conn,"
                SELECT * FROM mutasi_bank
                ORDER BY id DESC
                ");

                $no = 1;

                while($data = mysqli_fetch_array($query)){

                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $data['nama_bank']; ?></td>

                    <td><?= $data['no_referensi']; ?></td>

                    <td>Rp <?= number_format($data['total']); ?></td>

                    <td><?= $data['tanggal']; ?></td>

                    <td>

                        <a href="pages/edit_mutasi.php?id=<?= $data['id']; ?>"
                        class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <a href="pages/hapus_mutasi.php?id=<?= $data['id']; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin hapus data?')">

                            Hapus

                        </a>

                    </td>

                </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>