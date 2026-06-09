<?php
$id = $_GET['id'] ?? '';
$stmt = mysqli_prepare($koneksi, "
    SELECT t.*, p.nama_pelanggan, pg.nama_pegawai
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id_pelanggan = t.id_pelanggan
    LEFT JOIN pegawai pg ON pg.id_pegawai = t.id_pegawai
    WHERE t.id_transaksi = ?
");
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$trx = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$trx) { set_flash('error', 'Transaksi tidak ditemukan.'); header('Location: ' . base_url('index.php?page=transaksi')); exit; }
$detail = mysqli_prepare($koneksi, "
    SELECT dt.*, m.nama_menu, m.harga
    FROM detail_transaksi dt
    JOIN menu m ON m.id_menu = dt.id_menu
    WHERE dt.id_transaksi = ?
");
mysqli_stmt_bind_param($detail, 's', $id);
mysqli_stmt_execute($detail);
$items = mysqli_stmt_get_result($detail);
?>
<div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-2 no-print">
    <h1 class="page-title h3 mb-0">Detail Transaksi</h1>
    <div>
        <button class="btn btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
        <a href="<?= base_url('index.php?page=transaksi'); ?>" class="btn btn-orange"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
    </div>
</div>
<div class="card content-card">
    <div class="card-body">
        <div class="d-flex justify-content-between border-bottom pb-3 mb-3">
            <div>
                <h2 class="h4 fw-bold mb-1">Ayam Ungkep</h2>
                <p class="text-muted mb-0">Struk transaksi <?= e($trx['id_transaksi']); ?></p>
            </div>
            <div class="text-end">
                <div><?= date('d/m/Y', strtotime($trx['tanggal'])); ?></div>
                <span class="badge badge-soft"><?= e($trx['metode_pembayaran']); ?></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6"><span class="text-muted">Pelanggan:</span> <strong><?= e($trx['nama_pelanggan']); ?></strong></div>
            <div class="col-md-6"><span class="text-muted">Pegawai:</span> <strong><?= e($trx['nama_pegawai']); ?></strong></div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Menu</th><th>Harga</th><th>Jumlah</th><th class="text-end">Subtotal</th></tr></thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($items)): ?>
                        <tr><td><?= e($row['nama_menu']); ?></td><td><?= rupiah($row['harga']); ?></td><td><?= e($row['jumlah']); ?></td><td class="text-end"><?= rupiah($row['subtotal']); ?></td></tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot><tr><th colspan="3" class="text-end">Total</th><th class="text-end"><?= rupiah($trx['total_harga']); ?></th></tr></tfoot>
            </table>
        </div>
    </div>
</div>
