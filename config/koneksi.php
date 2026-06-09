<?php
// Konfigurasi koneksi database MySQL.
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_penjualan_ayam_ungkep';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8mb4');
date_default_timezone_set('Asia/Jakarta');
?>
