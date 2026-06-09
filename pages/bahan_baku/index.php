<?php
$bahan = mysqli_query($koneksi, "
    SELECT b.*, s.nama_supplier
    FROM bahan_baku b
    LEFT JOIN supplier s ON s.id_supplier = b.id_supplier
    ORDER BY b.id_bahan DESC
");
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="page-title h3 mb-1">Bahan Baku</h1>
        <p class="text-muted mb-0">Stok akan berkurang otomatis saat detail transaksi tersimpan.</p>
    </div>
    <a class="btn btn-orange" href="<?= base_url('index.php?page=bahan_baku_tambah'); ?>"><i class="bi bi-plus-circle me-1"></i>Tambah Bahan</a>
</div>
<div class="card content-card"><div class="card-body"><div class="table-responsive">
    <table class="table table-hover align-middle datatable">
        <thead><tr><th>ID</th><th>Nama Bahan</th><th>Stok</th><th>Satuan</th><th>Supplier</th><th class="text-end">Aksi</th></tr></thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($bahan)): ?>
            <tr>
                <td><?= e($row['id_bahan']); ?></td>
                <td class="fw-semibold"><?= e($row['nama_bahan']); ?></td>
                <td><?= e($row['stok']); ?></td>
                <td><?= e($row['satuan']); ?></td>
                <td><?= e($row['nama_supplier'] ?? '-'); ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="<?= base_url('index.php?page=bahan_baku_edit&id=' . $row['id_bahan']); ?>"><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-sm btn-outline-danger btn-delete" href="<?= base_url('index.php?page=bahan_baku_hapus&id=' . $row['id_bahan']); ?>"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div></div></div>
