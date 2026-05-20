<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'DELETE FROM menu WHERE id_menu = ?');
mysqli_stmt_bind_param($stmt, 's', $id);

if (mysqli_stmt_execute($stmt)) {
    set_flash('success', 'Menu berhasil dihapus.');
} else {
    set_flash('error', 'Menu tidak bisa dihapus karena sudah dipakai transaksi/resep.');
}

header('Location: ' . base_url('index.php?page=menu'));
exit;
?>
