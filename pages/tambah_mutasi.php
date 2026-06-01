<?php
include '../config/koneksi.php';

// Memeriksa kiriman form berdasarkan salah satu field input wajib (lebih aman di server cloud)
if (isset($_POST['nama_bank'])) {

    $nama_bank    = $_POST['nama_bank'];
    $no_referensi = $_POST['no_referensi'];
    $total        = $_POST['total'];
    $tanggal      = $_POST['tanggal'];

    // Menggunakan INSERT INTO dengan mendefinisikan kolom secara spesifik agar tidak bentrok dengan auto_increment ID
    $query = "INSERT INTO mutasi_bank (nama_bank, no_referensi, total, tanggal) 
              VALUES ('$nama_bank', '$no_referensi', '$total', '$tanggal')";
    
    $eksekusi = mysqli_query($conn, $query);

    // Jika eksekusi berhasil, langsung redirect kembali ke halaman utama mutasi_bank
    if ($eksekusi) {
        header("Location: ../mutasi_bank.php");
        exit(); // Wajib ditambahkan setelah header location agar PHP langsung berhenti membaca kode di bawahnya
    } else {
        // Jika gagal insert, tampilkan error agar tidak blank putih polos
        die("Gagal menyimpan data ke database: " . mysqli_error($conn));
    }
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
        body {
            background: #f5f7fb;
        }
        .card {
            border: none;
            border-radius: 20px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body p-5">
            <h2 class="mb-4">Tambah Mutasi Bank</h2>

            <form method="POST">
                <div class="mb-3">
                    <label>Nama Bank</label>
                    <input type="text" name="nama_bank" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No Referensi</label>
                    <input type="text" name="no_referensi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Total</label>
                    <input type="number" name="total" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Mutasi</button>
                <a href="../mutasi_bank.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>