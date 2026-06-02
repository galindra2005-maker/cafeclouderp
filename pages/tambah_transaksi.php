<?php
include '../config/koneksi.php';

if(isset($_POST['simpan'])){

    $no_transaksi = $_POST['no_transaksi'];
    $metode       = $_POST['metode'];
    $total        = $_POST['total'];

    // =========================
    // LOGIC AI REKONSILIASI
    // =========================

    if($total < 30000){
        $status = "Matched";
    }
    elseif($total >= 30000 && $total <= 50000){
        $status = "Belum Cocok";
    }
    else{
        $status = "Mencurigakan";
    }

    // =========================
    // INSERT DATABASE (FIXED)
    // =========================
    
    // Perbaikan: Tidak menyertakan kolom id agar terisi otomatis oleh auto_increment
    $query = "INSERT INTO transaksi_kasir (no_transaksi, metode, total, status_ai) 
              VALUES ('$no_transaksi', '$metode', '$total', '$status')";
    
    $result = mysqli_query($conn, $query);

    if($result){
        header("Location: ../index.php");
        exit(); // Wajib ditambahkan agar proses redirect sempurna
    } else {
        die("Error database: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{ background:#f5f7fb; font-family:Arial, Helvetica, sans-serif; }
        .card-form{ border:none; border-radius:25px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
        .title{ font-size:35px; font-weight:bold; margin-bottom:30px; }
        .form-control, .form-select{ height:50px; border-radius:12px; }
        .btn-primary{ border-radius:12px; padding:12px 20px; font-size:16px; }
        .info-ai{ background:#e9f3ff; padding:15px; border-radius:15px; margin-bottom:25px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-form">
                <div class="card-body p-5">
                    <div class="title">Tambah Transaksi AI</div>
                    
                    <div class="info-ai">
                        <b>AI Rekonsiliasi Aktif:</b>
                        <ul class="mt-2">
                            <li>< 30.000 = Matched</li>
                            <li>30.000 - 50.000 = Belum Cocok</li>
                            <li>> 50.000 = Mencurigakan</li>
                        </ul>
                    </div>

                    <form method="POST">
                        <div class="mb-4">
                            <label class="mb-2">No Transaksi</label>
                            <input type="text" name="no_transaksi" class="form-control" placeholder="Masukkan nomor transaksi" required>
                        </div>

                        <div class="mb-4">
                            <label class="mb-2">Metode Pembayaran</label>
                            <select name="metode" class="form-select">
                                <option>QRIS</option>
                                <option>Transfer Bank</option>
                                <option>Cash</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="mb-2">Total Transaksi</label>
                            <input type="number" name="total" class="form-control" placeholder="Masukkan total transaksi" required>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">Simpan & Analisis AI</button>
                        <a href="../index.php" class="btn btn-secondary ms-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>