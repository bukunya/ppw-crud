<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Transaksi</h1>
        
        <?php
        // Include file koneksi database
        include_once("db_config.php");
          // Cek apakah form telah di-submit
        if(isset($_POST['submit'])) {
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
              // Jika tidak ada error, simpan data
            if(empty($errors)) {
                $result = mysqli_query($conn, "INSERT INTO lapkeu_transaction(business_id, date, description) 
                                               VALUES('$business_id', '$date', '$description')");
                  if($result) {
                    echo "<div class='alert alert-success'>";
                    echo "Data transaksi berhasil ditambahkan. <a href='index.php' style='color: var(--dark-purple); font-weight: 600;'>Lihat Data</a>";
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
        ?>
          <form action="tambah.php" method="post">
            <div class="form-group">
                <label for="business_id">ID Bisnis</label>
                <input type="number" name="business_id" id="business_id" required>
            </div>
            
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" name="date" id="date" required>
            </div>
            
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            
            <div style="margin-top: 20px;">
                <input type="submit" name="submit" value="Simpan" class="btn">
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>