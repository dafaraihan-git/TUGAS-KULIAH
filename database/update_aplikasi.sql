USE db_penjualan_ayam_ungkep;

ALTER TABLE menu
    ADD COLUMN IF NOT EXISTS gambar VARCHAR(150) NULL AFTER harga;

CREATE TABLE IF NOT EXISTS admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nama_admin VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (nama_admin, username, password)
SELECT 'Administrator', 'admin', '$2y$10$cCvc.Il26/SohXlUNWOdS.IJmtQWzTa2k3KAyRpt7Crr.NS9Pu3.a'
WHERE NOT EXISTS (SELECT 1 FROM admin WHERE username = 'admin');
