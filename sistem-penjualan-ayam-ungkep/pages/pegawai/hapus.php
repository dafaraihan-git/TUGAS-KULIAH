<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'DELETE FROM pegawai WHERE id_pegawai = ?');
mysqli_stmt_bind_param($stmt, 's', $id);
if (mysqli_stmt_execute($stmt)) {
    set_flash('success', 'Pegawai berhasil dihapus.');
} else {
    set_flash('error', 'Pegawai tidak bisa dihapus karena sudah punya transaksi.');
}
header('Location: ' . base_url('index.php?page=pegawai'));
exit;
?>
