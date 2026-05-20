<?php
$mulai = $_GET['mulai'] ?? date('Y-m-01');
$sampai = $_GET['sampai'] ?? date('Y-m-d');
$stmt = mysqli_prepare($koneksi, 'SELECT * FROM laporan_penjualan WHERE tanggal BETWEEN ? AND ? ORDER BY tanggal ASC, id_transaksi ASC');
mysqli_stmt_bind_param($stmt, 'ss', $mulai, $sampai);
mysqli_stmt_execute($stmt);
$laporan = mysqli_stmt_get_result($stmt);
$totalStmt = mysqli_prepare($koneksi, 'SELECT COALESCE(SUM(subtotal),0) AS total FROM laporan_penjualan WHERE tanggal BETWEEN ? AND ?');
mysqli_stmt_bind_param($totalStmt, 'ss', $mulai, $sampai);
mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'] ?? 0;
?>
<div class="card content-card">
    <div class="card-body">
        <div class="text-center mb-4">
            <h1 class="h3 fw-bold mb-1">Laporan Penjualan Ayam Ungkep</h1>
            <p class="text-muted mb-0">Periode <?= date('d/m/Y', strtotime($mulai)); ?> - <?= date('d/m/Y', strtotime($sampai)); ?></p>
        </div>
        <table class="table table-bordered align-middle">
            <thead><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Menu</th><th>Jumlah</th><th class="text-end">Subtotal</th></tr></thead>
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
            <tfoot><tr><th colspan="5" class="text-end">Total Pendapatan</th><th class="text-end"><?= rupiah($total); ?></th></tr></tfoot>
        </table>
        <div class="text-end no-print mt-3">
            <button class="btn btn-orange" onclick="window.print()"><i class="bi bi-printer me-1"></i>Cetak / Save PDF</button>
        </div>
    </div>
</div>
<script>window.addEventListener('load', () => setTimeout(() => window.print(), 500));</script>
