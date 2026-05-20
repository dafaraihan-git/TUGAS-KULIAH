<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, 'SELECT * FROM menu WHERE id_menu = ?');
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$menu = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$menu) {
    set_flash('error', 'Menu tidak ditemukan.');
    header('Location: ' . base_url('index.php?page=menu'));
    exit;
}

$kategori = mysqli_query($koneksi, 'SELECT * FROM kategori_menu ORDER BY nama_kategori ASC');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $idKategori = trim($_POST['id_kategori'] ?? '');
        $nama = trim($_POST['nama_menu'] ?? '');
        $harga = (int) ($_POST['harga'] ?? 0);
        $gambar = $menu['gambar'] ?? null;
        $gambarBaru = upload_gambar_menu();

        if ($gambarBaru) {
            $gambar = $gambarBaru;
        }

        if ($idKategori === '' || $nama === '' || $harga <= 0) {
            throw new Exception('Kategori, nama menu, dan harga wajib diisi.');
        }

        $update = mysqli_prepare($koneksi, 'UPDATE menu SET id_kategori = ?, nama_menu = ?, harga = ?, gambar = ? WHERE id_menu = ?');
        mysqli_stmt_bind_param($update, 'ssiss', $idKategori, $nama, $harga, $gambar, $id);
        mysqli_stmt_execute($update);

        set_flash('success', 'Menu berhasil diperbarui.');
        header('Location: ' . base_url('index.php?page=menu'));
        exit;
    } catch (Exception $e) {
        set_flash('error', $e->getMessage());
    }
}
?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title h3 mb-0">Edit Menu</h1>
    <a href="<?= base_url('index.php?page=menu'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="card content-card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select" required>
                    <?php while ($row = mysqli_fetch_assoc($kategori)): ?>
                        <option value="<?= e($row['id_kategori']); ?>" <?= $row['id_kategori'] === $menu['id_kategori'] ? 'selected' : ''; ?>><?= e($row['nama_kategori']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" value="<?= e($menu['nama_menu']); ?>" required maxlength="100">
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= e($menu['harga']); ?>" required min="1">
            </div>
            <div class="col-md-6">
                <label class="form-label">Gambar Menu</label>
                <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                <?php if (!empty($menu['gambar'])): ?>
                    <small class="text-muted">Gambar saat ini: <?= e($menu['gambar']); ?></small>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Update</button>
            </div>
        </form>
    </div>
</div>
