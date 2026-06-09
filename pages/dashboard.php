<?php
$totalMenu = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) AS total FROM menu'))['total'] ?? 0;
$totalTransaksi = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) AS total FROM transaksi'))['total'] ?? 0;
$totalPelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) AS total FROM pelanggan'))['total'] ?? 0;
$totalPendapatan = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COALESCE(SUM(total_harga),0) AS total FROM transaksi'))['total'] ?? 0;

$chartLabels = [];
$chartData = [];
$chartQuery = mysqli_query($koneksi, "
    SELECT tanggal, SUM(total_harga) AS total
    FROM transaksi
    GROUP BY tanggal
    ORDER BY tanggal ASC
    LIMIT 7
");
while ($row = mysqli_fetch_assoc($chartQuery)) {
    $chartLabels[] = date('d M', strtotime($row['tanggal']));
    $chartData[] = (int) $row['total'];
}

$transaksiTerbaru = mysqli_query($koneksi, "
    SELECT t.id_transaksi, t.tanggal, t.total_harga, t.metode_pembayaran, p.nama_pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id_pelanggan = t.id_pelanggan
    ORDER BY t.tanggal DESC, t.id_transaksi DESC
    LIMIT 5
");
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="page-title h3 mb-1">Dashboard</h1>
        <p class="text-muted mb-0">Ringkasan penjualan dan aktivitas kasir hari ini.</p>
    </div>
    <span class="badge badge-soft px-3 py-2"><i class="bi bi-calendar3 me-1"></i><?= date('d M Y'); ?></span>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><p class="text-muted mb-1">Total Menu</p><h3 class="mb-0"><?= e($totalMenu); ?></h3></div>
                <div class="stat-icon"><i class="bi bi-card-list fs-4"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><p class="text-muted mb-1">Transaksi</p><h3 class="mb-0"><?= e($totalTransaksi); ?></h3></div>
                <div class="stat-icon"><i class="bi bi-receipt fs-4"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><p class="text-muted mb-1">Pelanggan</p><h3 class="mb-0"><?= e($totalPelanggan); ?></h3></div>
                <div class="stat-icon"><i class="bi bi-people fs-4"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><p class="text-muted mb-1">Pendapatan</p><h3 class="mb-0 fs-5"><?= rupiah($totalPendapatan); ?></h3></div>
                <div class="stat-icon"><i class="bi bi-cash-stack fs-4"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card content-card">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Grafik Penjualan</h2>
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card content-card">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Transaksi Terbaru</h2>
                <?php while ($row = mysqli_fetch_assoc($transaksiTerbaru)): ?>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <div>
                            <div class="fw-semibold"><?= e($row['id_transaksi']); ?></div>
                            <small class="text-muted"><?= e($row['nama_pelanggan'] ?? '-'); ?> • <?= e($row['metode_pembayaran']); ?></small>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold"><?= rupiah($row['total_harga']); ?></div>
                            <small class="text-muted"><?= date('d/m/Y', strtotime($row['tanggal'])); ?></small>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('salesChart');
    if (!el) return;
    new Chart(el, {
        type: 'line',
        data: {
            labels: <?= json_encode($chartLabels); ?>,
            datasets: [{
                label: 'Pendapatan',
                data: <?= json_encode($chartData); ?>,
                borderColor: '#e8590c',
                backgroundColor: 'rgba(248, 113, 22, .18)',
                tension: .35,
                fill: true
            }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });
});
</script>
