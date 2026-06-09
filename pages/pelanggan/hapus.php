<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'DELETE FROM pelanggan WHERE id_pelanggan = ?');
mysqli_stmt_bind_param($stmt, 's', $id);
if (mysqli_stmt_execute($stmt)) { set_flash('success', 'Pelanggan berhasil dihapus.'); } else { set_flash('error', 'Pelanggan tidak bisa dihapus karena sudah punya transaksi.'); }
header('Location: ' . base_url('index.php?page=pelanggan')); exit;
?>
