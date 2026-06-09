<?php
$mulai = $_GET['mulai'] ?? date('Y-m-01');
$sampai = $_GET['sampai'] ?? date('Y-m-d');

$stmt = mysqli_prepare($koneksi, "
    SELECT *
    FROM laporan_penjualan
    WHERE tanggal BETWEEN ? AND ?
    ORDER BY tanggal DESC, id_transaksi DESC
");
mysqli_stmt_bind_param($stmt, 'ss', $mulai, $sampai);
mysqli_stmt_execute($stmt);
$laporan = mysqli_stmt_get_result($stmt);

$totalStmt = mysqli_prepare($koneksi, 'SELECT COALESCE(SUM(subtotal),0) AS total FROM laporan_penjualan WHERE tanggal BETWEEN ? AND ?');
mysqli_stmt_bind_param($totalStmt, 'ss', $mulai, $sampai);
mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'] ?? 0;
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="page-title h3 mb-1">Laporan Penjualan</h1>
        <p class="text-muted mb-0">Laporan diambil dari view <code>laporan_penjualan</code>.</p>
    </div>
    <div class="no-print">
        <a class="btn btn-outline-secondary" target="_blank" href="<?= base_url('index.php?page=laporan_cetak&mulai=' . $mulai . '&sampai=' . $sampai); ?>"><i class="bi bi-filetype-pdf me-1"></i>Export PDF</a>
        <button class="btn btn-orange" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
    </div>
</div>

<div class="card content-card mb-4 no-print">
    <div class="card-body">
        <form class="row g-3 align-items-end" method="get">
            <input type="hidden" name="page" value="laporan">
            <div class="col-md-4"><label class="form-label">Tanggal Mulai</label><input type="date" name="mulai" class="form-control" value="<?= e($mulai); ?>"></div>
            <div class="col-md-4"><label class="form-label">Tanggal Sampai</label><input type="date" name="sampai" class="form-control" value="<?= e($sampai); ?>"></div>
            <div class="col-md-4"><button class="btn btn-orange" type="submit"><i class="bi bi-funnel me-1"></i>Filter</button></div>
        </form>
    </div>
</div>

<div class="card content-card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 fw-bold mb-0">Periode <?= date('d/m/Y', strtotime($mulai)); ?> - <?= date('d/m/Y', strtotime($sampai)); ?></h2>
            <div class="fs-5 fw-bold text-danger"><?= rupiah($total); ?></div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead><tr><th>ID Transaksi</th><th>Tanggal</th><th>Pelanggan</th><th>Menu</th><th>Jumlah</th><th class="text-end">Subtotal</th></tr></thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($laporan)): ?>
                    <tr>
                        <td><?= e($row['id_transaksi']); ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                        <td><?= e($row['nama_pelanggan']); ?></td>
                        <td><?= e($row['nama_menu']); ?></td>
                        <td><?= e($row['jumlah']); ?></td>
                        <td class="text-end"><?= rupiah($row['subtotal']); ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
