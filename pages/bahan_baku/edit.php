<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'SELECT * FROM bahan_baku WHERE id_bahan = ?');
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$data) { set_flash('error', 'Bahan tidak ditemukan.'); header('Location: ' . base_url('index.php?page=bahan_baku')); exit; }
$supplier = mysqli_query($koneksi, 'SELECT * FROM supplier ORDER BY nama_supplier ASC');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_bahan'] ?? '');
    $stok = (float) ($_POST['stok'] ?? 0);
    $satuan = trim($_POST['satuan'] ?? '');
    $idSupplier = trim($_POST['id_supplier'] ?? '');
    $update = mysqli_prepare($koneksi, 'UPDATE bahan_baku SET nama_bahan = ?, stok = ?, satuan = ?, id_supplier = ? WHERE id_bahan = ?');
    mysqli_stmt_bind_param($update, 'sdsss', $nama, $stok, $satuan, $idSupplier, $id);
    mysqli_stmt_execute($update);
    set_flash('success', 'Bahan baku berhasil diperbarui.');
    header('Location: ' . base_url('index.php?page=bahan_baku'));
    exit;
}
?>
<div class="d-flex align-items-center justify-content-between mb-4"><h1 class="page-title h3 mb-0">Edit Bahan</h1><a href="<?= base_url('index.php?page=bahan_baku'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="card content-card"><div class="card-body">
    <form method="post" class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama Bahan</label><input type="text" name="nama_bahan" class="form-control" value="<?= e($data['nama_bahan']); ?>" required></div>
        <div class="col-md-3"><label class="form-label">Stok</label><input type="number" step="0.01" name="stok" class="form-control" value="<?= e($data['stok']); ?>" required min="0"></div>
        <div class="col-md-3"><label class="form-label">Satuan</label><input type="text" name="satuan" class="form-control" value="<?= e($data['satuan']); ?>" required></div>
        <div class="col-md-6"><label class="form-label">Supplier</label><select name="id_supplier" class="form-select" required><?php while ($row = mysqli_fetch_assoc($supplier)): ?><option value="<?= e($row['id_supplier']); ?>" <?= $row['id_supplier'] === $data['id_supplier'] ? 'selected' : ''; ?>><?= e($row['nama_supplier']); ?></option><?php endwhile; ?></select></div>
        <div class="col-12"><button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Update</button></div>
    </form>
</div></div>
