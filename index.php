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

<title>Cafe Cloud ERP AI</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    background:#f5f7fb;
    font-family:Arial, Helvetica, sans-serif;
}

/* SIDEBAR */

.sidebar{
    width:260px;
    height:100vh;
    background:#071c3f;
    position:fixed;
    padding:25px;
    color:white;
}

.sidebar h2{
    font-size:30px;
    margin-bottom:40px;
    font-weight:bold;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:14px;
    border-radius:12px;
    margin-bottom:10px;
    transition:0.3s;
    font-size:16px;
}

.sidebar a:hover{
    background:#0d6efd;
}

/* CONTENT */

.content{
    margin-left:280px;
    padding:35px;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.title{
    font-size:38px;
    font-weight:bold;
}

.date{
    color:gray;
}

/* CARD */

.card-box{
    background:white;
    border-radius:20px;
    padding:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
    margin-bottom:25px;
}

.card-box h6{
    color:gray;
}

.card-box h2{
    font-size:40px;
    font-weight:bold;
}

/* TABLE */

.table th{
    padding:15px;
    background:#f8f9fa;
}

.table td{
    padding:15px;
    vertical-align:middle;
}

/* BADGE */

.badge{
    padding:10px 14px;
    border-radius:10px;
    font-size:13px;
}

.btn-primary,
.btn-warning,
.btn-danger{
    border-radius:10px;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <h2>☕ CircleCoffe</h2>

    <a href="#">🏠 Dashboard</a>
    <a href="transaksi.php">💳 Transaksi</a>
    <a href="mutasi_bank.php">🏦 Mutasi Bank</a>
    <a href="rekonsiliasi.php">🤖 Rekonsiliasi AI</a>
    <a href="laporan.php">📊 Laporan</a>
    <a href="pengaturan.php">⚙️ Pengaturan</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<!-- CONTENT -->

<div class="content">

    <!-- TOPBAR -->

    <div class="topbar">

        <div class="title">
            Dashboard
        </div>

        <div class="date">
            <?= date('d F Y'); ?>
        </div>

    </div>

    <!-- CARD -->

    <div class="row">

        <div class="col-md-3">

            <div class="card-box">

                <h6>Total Transaksi</h6>

                <h2>

                    <?php
                    $total = mysqli_query($conn, "SELECT * FROM transaksi_kasir");
                    echo mysqli_num_rows($total);
                    ?>

                </h2>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card-box">

                <h6>Matched</h6>

                <h2>

                    <?php
                    $matched = mysqli_query($conn, "SELECT * FROM transaksi_kasir WHERE status='Matched'");
                    echo mysqli_num_rows($matched);
                    ?>

                </h2>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card-box">

                <h6>Belum Cocok</h6>

                <h2>

                    <?php
                    $belum = mysqli_query($conn, "SELECT * FROM transaksi_kasir WHERE status='Belum Cocok'");
                    echo mysqli_num_rows($belum);
                    ?>

                </h2>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card-box">

                <h6>Mencurigakan</h6>

                <h2>

                    <?php
                    $curiga = mysqli_query($conn, "SELECT * FROM transaksi_kasir WHERE status='Mencurigakan'");
                    echo mysqli_num_rows($curiga);
                    ?>

                </h2>

            </div>

        </div>

    </div>

    <!-- CHART -->

    <div class="card-box">

        <h4 class="mb-4">
            Grafik Rekonsiliasi AI
        </h4>

        <canvas id="myChart"></canvas>

    </div>

    <!-- TABLE -->

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4>Data Transaksi</h4>

            <a href="pages/tambah_transaksi.php"
            class="btn btn-primary">

                + Tambah Transaksi

            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Metode</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $query = mysqli_query($conn, "SELECT * FROM transaksi_kasir");

                    $no = 1;

                    while($data = mysqli_fetch_array($query)){

                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $data['no_transaksi']; ?></td>

                        <td><?= $data['metode']; ?></td>

                        <td>Rp <?= number_format($data['total']); ?></td>

                        <td>

                            <?php

                            if($data['status'] == "Matched"){

                                echo "<span class='badge bg-success'>Matched</span>";

                            }

                            elseif($data['status'] == "Belum Cocok"){

                                echo "<span class='badge bg-warning text-dark'>Belum Cocok</span>";

                            }

                            else{

                                echo "<span class='badge bg-danger'>Mencurigakan</span>";

                            }

                            ?>

                        </td>

                        <td>

                            <a href="pages/edit_transaksi.php?id=<?= $data['id']; ?>"
                            class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="pages/hapus_transaksi.php?id=<?= $data['id']; ?>"
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

<!-- CHART JS -->

<script>

const ctx = document.getElementById('myChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Matched', 'Belum Cocok', 'Mencurigakan'],

        datasets: [{

            label: 'Data Rekonsiliasi',

            data: [

                <?= mysqli_num_rows($matched); ?>,
                <?= mysqli_num_rows($belum); ?>,
                <?= mysqli_num_rows($curiga); ?>

            ],

            borderWidth: 1

        }]

    },

    options: {

        responsive: true

    }

});

</script>

</body>
</html>