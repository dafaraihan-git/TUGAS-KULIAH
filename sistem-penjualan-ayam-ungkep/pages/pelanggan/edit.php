<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'SELECT * FROM pelanggan WHERE id_pelanggan = ?');
mysqli_stmt_bind_param($stmt, 's', $id); mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$data) { set_flash('error', 'Pelanggan tidak ditemukan.'); header('Location: ' . base_url('index.php?page=pelanggan')); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_pelanggan'] ?? ''); $hp = trim($_POST['no_hp'] ?? ''); $alamat = trim($_POST['alamat'] ?? '');
    $update = mysqli_prepare($koneksi, 'UPDATE pelanggan SET nama_pelanggan = ?, no_hp = ?, alamat = ? WHERE id_pelanggan = ?');
    mysqli_stmt_bind_param($update, 'ssss', $nama, $hp, $alamat, $id); mysqli_stmt_execute($update);
    set_flash('success', 'Pelanggan berhasil diperbarui.'); header('Location: ' . base_url('index.php?page=pelanggan')); exit;
}
?>
<div class="d-flex align-items-center justify-content-between mb-4"><h1 class="page-title h3 mb-0">Edit Pelanggan</h1><a href="<?= base_url('index.php?page=pelanggan'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="card content-card"><div class="card-body"><form method="post" class="row g-3"><div class="col-md-6"><label class="form-label">Nama</label><input class="form-control" name="nama_pelanggan" value="<?= e($data['nama_pelanggan']); ?>" required></div><div class="col-md-6"><label class="form-label">No HP</label><input class="form-control" name="no_hp" value="<?= e($data['no_hp']); ?>" maxlength="15"></div><div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" name="alamat" rows="3"><?= e($data['alamat']); ?></textarea></div><div class="col-12"><button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Update</button></div></form></div></div>
