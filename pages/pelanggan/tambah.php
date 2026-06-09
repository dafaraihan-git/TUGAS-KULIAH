<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = next_id($koneksi, 'pelanggan', 'id_pelanggan', 'PL');
    $nama = trim($_POST['nama_pelanggan'] ?? '');
    $hp = trim($_POST['no_hp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    if ($nama !== '') {
        $stmt = mysqli_prepare($koneksi, 'INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, no_hp, alamat) VALUES (?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'ssss', $id, $nama, $hp, $alamat);
        mysqli_stmt_execute($stmt);
        set_flash('success', 'Pelanggan berhasil ditambahkan.');
        header('Location: ' . base_url('index.php?page=pelanggan')); exit;
    }
    set_flash('error', 'Nama pelanggan wajib diisi.');
}
?>
<div class="d-flex align-items-center justify-content-between mb-4"><h1 class="page-title h3 mb-0">Tambah Pelanggan</h1><a href="<?= base_url('index.php?page=pelanggan'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="card content-card"><div class="card-body"><form method="post" class="row g-3"><div class="col-md-6"><label class="form-label">Nama</label><input class="form-control" name="nama_pelanggan" required></div><div class="col-md-6"><label class="form-label">No HP</label><input class="form-control" name="no_hp" maxlength="15"></div><div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" name="alamat" rows="3"></textarea></div><div class="col-12"><button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Simpan</button></div></form></div></div>
