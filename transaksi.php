
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

<title>Data Transaksi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    font-family:Arial, Helvetica, sans-serif;
}

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

.table th{
    background:#f8f9fa;
}

.badge{
    padding:10px 14px;
    border-radius:10px;
}

.btn{
    border-radius:10px;
}

.search-box{
    width:300px;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

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

<!-- CONTENT -->

<div class="content">

    <div class="title">
        Data Transaksi
    </div>

    <div class="card-box">

        <!-- TOP -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <form method="GET">

                <input type="text"
                name="search"
                class="form-control search-box"
                placeholder="Cari transaksi...">

            </form>

            <a href="pages/tambah_transaksi.php"
            class="btn btn-primary">

                + Tambah Transaksi

            </a>

        </div>

        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Metode</th>
                        <th>Total</th>
                        <th>Status AI</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    if(isset($_GET['search'])){

                        $search = $_GET['search'];

                        $query = mysqli_query($conn, "
                        SELECT * FROM transaksi_kasir
                        WHERE no_transaksi LIKE '%$search%'
                        OR metode LIKE '%$search%'
                        OR status LIKE '%$search%'
                        ");

                    }else{

                        $query = mysqli_query($conn, "
                        SELECT * FROM transaksi_kasir
                        ");

                    }

                    $no = 1;

                    while($data = mysqli_fetch_array($query)){

                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $data['no_transaksi']; ?></td>

                        <td><?= $data['metode']; ?></td>

                        <td>
                            Rp <?= number_format($data['total']); ?>
                        </td>

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
                            onclick="return confirm('Yakin ingin hapus?')">

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
