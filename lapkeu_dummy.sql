-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS lapkeu_dummy;
USE lapkeu_dummy;

-- Drop table if exists to avoid conflicts
DROP TABLE IF EXISTS lapkeu_transaction;

-- Create the transaction table
CREATE TABLE lapkeu_transaction (
    transaction_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    business_id INT(11) NOT NULL,
    date DATE NOT NULL,
    description VARCHAR(200) NOT NULL
);

-- Insert dummy data for transactions
INSERT INTO lapkeu_transaction (business_id, date, description) VALUES 
(1001, '2025-05-15', 'Pembayaran gaji karyawan'),
(1002, '2025-05-18', 'Pembelian alat kantor'),
(1001, '2025-05-20', 'Pendapatan penjualan produk A'),
(1003, '2025-05-22', 'Pembayaran sewa gedung'),
(1002, '2025-05-25', 'Biaya transportasi'),
(1004, '2025-05-26', 'Pembayaran listrik dan air'),
(1001, '2025-05-27', 'Pendapatan penjualan produk B'),
(1003, '2025-05-28', 'Biaya pemeliharaan peralatan');

-- Create database user if needed (optional)
-- GRANT ALL PRIVILEGES ON lapkeu_dummy.* TO 'lapkeu_user'@'localhost' IDENTIFIED BY 'password';
-- FLUSH PRIVILEGES;