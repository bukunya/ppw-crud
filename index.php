<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containeridx">
        <h1>Data Transaksi</h1>
        
        <div class="header-action">
            <a href="tambah.php" class="btn">Tambah Transaksi</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>ID Bisnis</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("db_config.php");                  // Query untuk mengambil data transaksi
                $result = mysqli_query($conn, "SELECT * FROM lapkeu_transaction ORDER BY transaction_id DESC");
                
                // Cek apakah ada data
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    // Looping untuk menampilkan data
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td>".$row['transaction_id']."</td>";
                        echo "<td>".$row['business_id']."</td>";
                        echo "<td>".$row['date']."</td>";
                        echo "<td>".$row['description']."</td>";                        echo "<td>";
                        echo "<a href='detail.php?id=".$row['transaction_id']."' class='btn'>Detail</a> ";
                        echo "<a href='edit.php?id=".$row['transaction_id']."' class='btn btn-edit'>Edit</a> ";
                        echo "<a href='hapus.php?id=".$row['transaction_id']."' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }                } else {
                    echo "<tr><td colspan='6' style='text-align:center'>Tidak ada data</td></tr>";
                }
                
                // Tutup koneksi
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>