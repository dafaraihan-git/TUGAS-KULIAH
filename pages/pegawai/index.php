<?php $pegawai = mysqli_query($koneksi, 'SELECT * FROM pegawai ORDER BY id_pegawai DESC'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div><h1 class="page-title h3 mb-1">Pegawai</h1><p class="text-muted mb-0">Kelola data kasir dan karyawan.</p></div>
    <a class="btn btn-orange" href="<?= base_url('index.php?page=pegawai_tambah'); ?>"><i class="bi bi-plus-circle me-1"></i>Tambah Pegawai</a>
</div>
<div class="card content-card"><div class="card-body"><div class="table-responsive">
    <table class="table table-hover align-middle datatable">
        <thead><tr><th>ID</th><th>Nama</th><th>Jabatan</th><th>No HP</th><th class="text-end">Aksi</th></tr></thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($pegawai)): ?>
            <tr>
                <td><?= e($row['id_pegawai']); ?></td>
                <td class="fw-semibold"><?= e($row['nama_pegawai']); ?></td>
                <td><span class="badge badge-soft"><?= e($row['jabatan']); ?></span></td>
                <td><?= e($row['no_hp']); ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="<?= base_url('index.php?page=pegawai_edit&id=' . $row['id_pegawai']); ?>"><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-sm btn-outline-danger btn-delete" href="<?= base_url('index.php?page=pegawai_hapus&id=' . $row['id_pegawai']); ?>"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div></div></div>
