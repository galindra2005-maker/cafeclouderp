<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

include 'config/koneksi.php';

if(isset($_POST['proses'])){

    mysqli_query($conn,"TRUNCATE TABLE rekonsiliasi");

    $transaksi = mysqli_query($conn,"
    SELECT * FROM transaksi_kasir
    ");

    while($t = mysqli_fetch_array($transaksi)){

        $mutasi = mysqli_fetch_array(mysqli_query($conn,"
        SELECT * FROM mutasi_bank
        WHERE total='$t[total]'
        LIMIT 1
        "));

        if($mutasi){

            $status = "Matched";

            $no_referensi = $mutasi['no_referensi'];

            $total_mutasi = $mutasi['total'];

        }else{

            $status = "Belum Cocok";

            $no_referensi = "-";

            $total_mutasi = 0;
        }

        mysqli_query($conn,"
        INSERT INTO rekonsiliasi
        (
            no_transaksi,
            no_referensi,
            total_transaksi,
            total_mutasi,
            status
        )
        VALUES
        (
            '$t[no_transaksi]',
            '$no_referensi',
            '$t[total]',
            '$total_mutasi',
            '$status'
        )
        ");
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Rekonsiliasi AI</title>

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

.badge{
    padding:10px;
    border-radius:10px;
}

</style>

</head>

<body>

<div class="sidebar">

    <h2>☕CircleCoffe</h2>

    <a href="index.php">🏠 Dashboard</a>
    <a href="transaksi.php">💳 Transaksi</a>
    <a href="mutasi_bank.php">🏦 Mutasi Bank</a>
    <a href="rekonsiliasi.php">🤖 Rekonsiliasi AI</a>
    <a href="laporan.php">📊 Laporan</a>
    <a href="pengaturan.php">⚙️ Pengaturan</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

    <div class="card-box">

        <h2 class="mb-4">
            Rekonsiliasi AI
        </h2>

        <form method="POST">

            <button
            type="submit"
            name="proses"
            class="btn btn-primary mb-4">

                🤖 Proses Rekonsiliasi AI

            </button>

        </form>

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

                    if($data['status']=="Matched"){

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

</body>
</html>