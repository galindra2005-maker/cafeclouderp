<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

include 'config/koneksi.php';

$total_transaksi = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM transaksi_kasir"));
$total_mutasi = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM mutasi_bank"));
$total_matched = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rekonsiliasi WHERE status='Matched'"));
$total_belum = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rekonsiliasi WHERE status='Belum Cocok'"));

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laporan ERP AI</title>

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

.title{
    font-size:35px;
    font-weight:bold;
    margin-bottom:25px;
}

.card-box{
    background:white;
    border-radius:20px;
    padding:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.stat-card{
    background:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.stat-card h3{
    font-weight:bold;
}

.badge{
    padding:10px;
    border-radius:10px;
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
        Laporan
    </div>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="stat-card">
                <h6>Total Transaksi</h6>
                <h3><?= $total_transaksi ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <h6>Total Mutasi</h6>
                <h3><?= $total_mutasi ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <h6>Matched</h6>
                <h3><?= $total_matched ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <h6>Belum Cocok</h6>
                <h3><?= $total_belum ?></h3>
            </div>
        </div>

    </div>

    <div class="card-box">

        <div class="d-flex justify-content-between mb-4">

            <h4>Laporan Rekonsiliasi AI</h4>

            <button onclick="window.print()" class="btn btn-primary">
                🖨 Print
            </button>

        </div>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>No Referensi</th>
                        <th>Total Transaksi</th>
                        <th>Total Mutasi</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $query = mysqli_query($conn,"
                SELECT * FROM rekonsiliasi
                ORDER BY id DESC
                ");

                $no = 1;

                while($data = mysqli_fetch_array($query)){

                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $data['no_transaksi']; ?></td>

                    <td><?= $data['no_referensi']; ?></td>

                    <td>Rp <?= number_format($data['total_transaksi']); ?></td>

                    <td>Rp <?= number_format($data['total_mutasi']); ?></td>

                    <td>

                        <?php

                        if($data['status'] == "Matched"){

                            echo "<span class='badge bg-success'>Matched</span>";

                        }else{

                            echo "<span class='badge bg-danger'>Belum Cocok</span>";

                        }

                        ?>

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