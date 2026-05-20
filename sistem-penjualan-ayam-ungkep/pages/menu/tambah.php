<?php
$kategori = mysqli_query($koneksi, 'SELECT * FROM kategori_menu ORDER BY nama_kategori ASC');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = next_id($koneksi, 'menu', 'id_menu', 'MN');
        $idKategori = trim($_POST['id_kategori'] ?? '');
        $nama = trim($_POST['nama_menu'] ?? '');
        $harga = (int) ($_POST['harga'] ?? 0);
        $gambar = upload_gambar_menu();

        if ($idKategori === '' || $nama === '' || $harga <= 0) {
            throw new Exception('Kategori, nama menu, dan harga wajib diisi.');
        }

        $stmt = mysqli_prepare($koneksi, 'INSERT INTO menu (id_menu, id_kategori, nama_menu, harga, gambar) VALUES (?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sssis', $id, $idKategori, $nama, $harga, $gambar);
        mysqli_stmt_execute($stmt);

        set_flash('success', 'Menu berhasil ditambahkan.');
        header('Location: ' . base_url('index.php?page=menu'));
        exit;
    } catch (Exception $e) {
        set_flash('error', $e->getMessage());
    }
}
?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title h3 mb-0">Tambah Menu</h1>
    <a href="<?= base_url('index.php?page=menu'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="card content-card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    <?php while ($row = mysqli_fetch_assoc($kategori)): ?>
                        <option value="<?= e($row['id_kategori']); ?>"><?= e($row['nama_kategori']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" required maxlength="100">
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required min="1">
            </div>
            <div class="col-md-6">
                <label class="form-label">Gambar Menu</label>
                <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                <small class="text-muted">Maksimal 2 MB.</small>
            </div>
            <div class="col-12">
                <button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>
