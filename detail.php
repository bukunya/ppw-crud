<?php
// Include file koneksi database
include_once("db_config.php");

// Cek apakah ada ID yang dikirimkan
if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM lapkeu_transaction WHERE transaction_id=$id");

// Jika data tidak ditemukan, kembali ke halaman utama
if(mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

// Ambil data untuk ditampilkan
$data = mysqli_fetch_assoc($result);
$transaction_id = $data['transaction_id'];
$business_id = $data['business_id'];
$date = $data['date'];
$description = $data['description'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Detail Transaksi</h1>
        
        <div class="detail-item">
            <span class="detail-label">ID Transaksi:</span>
            <span><?php echo $transaction_id; ?></span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">ID Bisnis:</span>
            <span><?php echo $business_id; ?></span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">Tanggal:</span>
            <span><?php echo $date; ?></span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">Deskripsi:</span>
            <span><?php echo $description; ?></span>
        </div>
        
        <div class="actions">
            <a href="index.php" class="btn">Kembali</a>
            <a href="edit.php?id=<?php echo $transaction_id; ?>" class="btn btn-edit">Edit</a>
            <a href="hapus.php?id=<?php echo $transaction_id; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
        </div>
    </div>
</body>
</html>
