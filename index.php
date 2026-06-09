<?php
require_once __DIR__ . '/includes/auth.php';

$routes = [
    'dashboard' => __DIR__ . '/pages/dashboard.php',
    'menu' => __DIR__ . '/pages/menu/index.php',
    'menu_tambah' => __DIR__ . '/pages/menu/tambah.php',
    'menu_edit' => __DIR__ . '/pages/menu/edit.php',
    'menu_hapus' => __DIR__ . '/pages/menu/hapus.php',
    'transaksi' => __DIR__ . '/pages/transaksi/index.php',
    'transaksi_simpan' => __DIR__ . '/pages/transaksi/simpan.php',
    'transaksi_detail' => __DIR__ . '/pages/transaksi/detail.php',
    'bahan_baku' => __DIR__ . '/pages/bahan_baku/index.php',
    'bahan_baku_tambah' => __DIR__ . '/pages/bahan_baku/tambah.php',
    'bahan_baku_edit' => __DIR__ . '/pages/bahan_baku/edit.php',
    'bahan_baku_hapus' => __DIR__ . '/pages/bahan_baku/hapus.php',
    'pelanggan' => __DIR__ . '/pages/pelanggan/index.php',
    'pelanggan_tambah' => __DIR__ . '/pages/pelanggan/tambah.php',
    'pelanggan_edit' => __DIR__ . '/pages/pelanggan/edit.php',
    'pelanggan_hapus' => __DIR__ . '/pages/pelanggan/hapus.php',
    'pegawai' => __DIR__ . '/pages/pegawai/index.php',
    'pegawai_tambah' => __DIR__ . '/pages/pegawai/tambah.php',
    'pegawai_edit' => __DIR__ . '/pages/pegawai/edit.php',
    'pegawai_hapus' => __DIR__ . '/pages/pegawai/hapus.php',
    'laporan' => __DIR__ . '/pages/laporan/index.php',
    'laporan_cetak' => __DIR__ . '/pages/laporan/cetak.php',
];

$page = $_GET['page'] ?? 'dashboard';
$content = $routes[$page] ?? $routes['dashboard'];
$flash = get_flash();
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Penjualan Ayam Ungkep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/includes/navbar.php'; ?>
<?php include __DIR__ . '/includes/sidebar.php'; ?>

<main class="app-main">
    <?php include $content; ?>
    <?php include __DIR__ . '/includes/footer.php'; ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/js/app.js'); ?>"></script>
<?php if ($flash): ?>
<script>
Swal.fire({
    icon: '<?= e($flash['type']); ?>',
    title: '<?= e($flash['message']); ?>',
    timer: 1800,
    showConfirmButton: false
});
</script>
<?php endif; ?>
</body>
</html>
