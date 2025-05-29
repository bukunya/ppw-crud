<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Transaksi</h1>
        
        <?php
        // Include file koneksi database
        include_once("db_config.php");
        
        // Cek apakah ada ID yang dikirimkan
        if(!isset($_GET['id'])) {
            header("Location: index.php");
            exit();
        }
        
        $id = $_GET['id'];
          // Cek apakah form telah di-submit
        if(isset($_POST['update'])) {
            $business_id = $_POST['business_id'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            
            // Validasi form
            $errors = array();
            
            if(empty($business_id)) {
                $errors[] = "ID Bisnis tidak boleh kosong";
            }
            
            if(empty($date)) {
                $errors[] = "Tanggal tidak boleh kosong";
            }
            
            if(empty($description)) {
                $errors[] = "Deskripsi tidak boleh kosong";
            }
              // Jika tidak ada error, update data
            if(empty($errors)) {
                $result = mysqli_query($conn, "UPDATE lapkeu_transaction SET 
                                               business_id='$business_id', 
                                               date='$date', 
                                               description='$description' 
                                               WHERE transaction_id=$id");                if($result) {
                    echo "<div class='alert alert-success'>";
                    echo "Data transaksi berhasil diperbarui. <a href='index.php' style='color: var(--dark-purple); font-weight: 600;'>Lihat Data</a>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-danger'>";
                    echo "Error: " . mysqli_error($conn);
                    echo "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>";
                echo "<ul>";
                foreach($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
        }
          // Ambil data transaksi berdasarkan ID
        $result = mysqli_query($conn, "SELECT * FROM lapkeu_transaction WHERE transaction_id=$id");
        
        // Jika data tidak ditemukan, kembali ke halaman utama
        if(mysqli_num_rows($result) == 0) {
            header("Location: index.php");
            exit();
        }
          // Ambil data untuk ditampilkan di form
        $row = mysqli_fetch_assoc($result);
        $business_id = $row['business_id'];
        $date = $row['date'];
        $description = $row['description'];
        ?>
          <form action="edit.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="business_id">ID Bisnis</label>
                <input type="number" name="business_id" id="business_id" value="<?php echo $business_id; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" name="date" id="date" value="<?php echo $date; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" required><?php echo $description; ?></textarea>
            </div>
            
            <div style="margin-top: 20px;">
                <input type="submit" name="update" value="Update" class="btn">
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>