<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = next_id($koneksi, 'pegawai', 'id_pegawai', 'PG');
    $nama = trim($_POST['nama_pegawai'] ?? '');
    $jabatan = trim($_POST['jabatan'] ?? '');
    $hp = trim($_POST['no_hp'] ?? '');

    if ($nama !== '') {
        $stmt = mysqli_prepare($koneksi, 'INSERT INTO pegawai (id_pegawai, nama_pegawai, jabatan, no_hp) VALUES (?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'ssss', $id, $nama, $jabatan, $hp);
        mysqli_stmt_execute($stmt);
        set_flash('success', 'Pegawai berhasil ditambahkan.');
        header('Location: ' . base_url('index.php?page=pegawai'));
        exit;
    }
    set_flash('error', 'Nama pegawai wajib diisi.');
}
?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title h3 mb-0">Tambah Pegawai</h1>
    <a href="<?= base_url('index.php?page=pegawai'); ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="card content-card"><div class="card-body">
    <form method="post" class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama</label><input class="form-control" name="nama_pegawai" required></div>
        <div class="col-md-6"><label class="form-label">Jabatan</label><input class="form-control" name="jabatan" placeholder="Kasir"></div>
        <div class="col-md-6"><label class="form-label">No HP</label><input class="form-control" name="no_hp" maxlength="15"></div>
        <div class="col-12"><button class="btn btn-orange" type="submit"><i class="bi bi-save me-1"></i>Simpan</button></div>
    </form>
</div></div>
