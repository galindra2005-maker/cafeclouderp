<?php
include '../config/koneksi.php';

if(isset($_POST['simpan'])){
    $no_transaksi = isset($_POST['no_transaksi']) ? $_POST['no_transaksi'] : '';
    $metode       = isset($_POST['metode']) ? $_POST['metode'] : '';
    $total        = isset($_POST['total']) ? (int)$_POST['total'] : 0;

    // Logika AI
    if($total < 30000){ $status = "Matched"; }
    elseif($total >= 30000 && $total <= 50000){ $status = "Belum Cocok"; }
    else{ $status = "Mencurigakan"; }

    // PERBAIKAN: Menggunakan kolom 'status' (sesuai database Railway kamu)
    $stmt = $conn->prepare("INSERT INTO transaksi_kasir (no_transaksi, metode, total, status) VALUES (?, ?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("ssis", $no_transaksi, $metode, $total, $status);
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../index.php");
            exit(); 
        } else {
            die("Execute failed: " . $stmt->error);
        }
    } else {
        die("Prepare failed: " . $conn->error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f5f7fb;">
<div class="container mt-5">
    <div class="card p-5 shadow-sm border-0 rounded-4">
        <h3>Tambah Transaksi</h3>
        <form method="POST">
            <div class="mb-3">
                <label>No Transaksi</label>
                <input type="text" name="no_transaksi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Metode</label>
                <select name="metode" class="form-select">
                    <option>QRIS</option><option>Transfer Bank</option><option>Cash</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Total</label>
                <input type="number" name="total" class="form-control" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>