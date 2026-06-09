<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'SELECT * FROM pegawai WHERE id_pegawai = ?');
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$data) {
    set_flash('error', 'Pegawai tidak ditemukan.');
    header('Location: ' . base_url('index.php?page=pegawai'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_pegawai'] ?? '');
    $jabatan = trim($_POST['jabatan'] ?? '');
    $hp = trim($_POST['no_hp'] ?? '');

    $update = mysqli_prepare($koneksi, 'UPDATE pegawai SET nama_pegawai = ?, jabatan = ?, no_hp = ? WHERE id_pegawai = ?');
    mysqli_stmt_bind_param($update, 'ssss', $nama, $jabatan, $hp, $id);
    mysqli_stmt_execute($update);
    set_flash('success', 'Pegawai berhasil diperbarui.');
    header('Location: ' . base_url('index.php?page=pegawai'));
    exit;
}
?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title h3 mb-0">Edit Pegawai</h1>
    <a href="<?= base_url('index.php?page=pegawai'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="card content-card"><div class="card-body">
    <form method="post" class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama</label><input class="form-control" name="nama_pegawai" value="<?= e($data['nama_pegawai']); ?>" required></div>
        <div class="col-md-6"><label class="form-label">Jabatan</label><input class="form-control" name="jabatan" value="<?= e($data['jabatan']); ?>"></div>
        <div class="col-md-6"><label class="form-label">No HP</label><input class="form-control" name="no_hp" value="<?= e($data['no_hp']); ?>" maxlength="15"></div>
        <div class="col-12"><button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Update</button></div>
    </form>
</div></div>
