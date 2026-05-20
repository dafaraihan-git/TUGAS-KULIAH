<?php
$supplier = mysqli_query($koneksi, 'SELECT * FROM supplier ORDER BY nama_supplier ASC');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = next_id($koneksi, 'bahan_baku', 'id_bahan', 'BB');
    $nama = trim($_POST['nama_bahan'] ?? '');
    $stok = (float) ($_POST['stok'] ?? 0);
    $satuan = trim($_POST['satuan'] ?? '');
    $idSupplier = trim($_POST['id_supplier'] ?? '');

    if ($nama !== '' && $satuan !== '' && $idSupplier !== '') {
        $stmt = mysqli_prepare($koneksi, 'INSERT INTO bahan_baku (id_bahan, nama_bahan, stok, satuan, id_supplier) VALUES (?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'ssdss', $id, $nama, $stok, $satuan, $idSupplier);
        mysqli_stmt_execute($stmt);
        set_flash('success', 'Bahan baku berhasil ditambahkan.');
        header('Location: ' . base_url('index.php?page=bahan_baku'));
        exit;
    }
    set_flash('error', 'Semua field wajib diisi.');
}
?>
<div class="d-flex align-items-center justify-content-between mb-4"><h1 class="page-title h3 mb-0">Tambah Bahan</h1><a href="<?= base_url('index.php?page=bahan_baku'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="card content-card"><div class="card-body">
    <form method="post" class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama Bahan</label><input type="text" name="nama_bahan" class="form-control" required></div>
        <div class="col-md-3"><label class="form-label">Stok</label><input type="number" step="0.01" name="stok" class="form-control" required min="0"></div>
        <div class="col-md-3"><label class="form-label">Satuan</label><input type="text" name="satuan" class="form-control" required placeholder="Kg / Liter"></div>
        <div class="col-md-6"><label class="form-label">Supplier</label><select name="id_supplier" class="form-select" required><option value="">Pilih supplier</option><?php while ($row = mysqli_fetch_assoc($supplier)): ?><option value="<?= e($row['id_supplier']); ?>"><?= e($row['nama_supplier']); ?></option><?php endwhile; ?></select></div>
        <div class="col-12"><button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Simpan</button></div>
    </form>
</div></div>
