<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'DELETE FROM bahan_baku WHERE id_bahan = ?');
mysqli_stmt_bind_param($stmt, 's', $id);
if (mysqli_stmt_execute($stmt)) { set_flash('success', 'Bahan baku berhasil dihapus.'); } else { set_flash('error', 'Bahan tidak bisa dihapus karena dipakai resep.'); }
header('Location: ' . base_url('index.php?page=bahan_baku'));
exit;
?>
