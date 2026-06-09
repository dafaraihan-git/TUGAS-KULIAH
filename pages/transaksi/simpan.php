<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . base_url('index.php?page=transaksi'));
    exit;
}

$idTransaksi = next_id($koneksi, 'transaksi', 'id_transaksi', 'TR');
$tanggal = $_POST['tanggal'] ?? date('Y-m-d');
$idPelanggan = $_POST['id_pelanggan'] ?? '';
$idPegawai = $_POST['id_pegawai'] ?? '';
$metode = $_POST['metode_pembayaran'] ?? 'Cash';
$menuIds = $_POST['id_menu'] ?? [];
$jumlahs = $_POST['jumlah'] ?? [];
$subtotals = $_POST['subtotal'] ?? [];
$total = (int) ($_POST['total_harga'] ?? 0);

try {
    if ($idPelanggan === '' || $idPegawai === '' || $total <= 0 || count($menuIds) === 0) {
        throw new Exception('Data transaksi belum lengkap.');
    }

    mysqli_begin_transaction($koneksi);

    $stmt = mysqli_prepare($koneksi, 'INSERT INTO transaksi (id_transaksi, tanggal, total_harga, metode_pembayaran, id_pelanggan, id_pegawai) VALUES (?, ?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'ssisss', $idTransaksi, $tanggal, $total, $metode, $idPelanggan, $idPegawai);
    mysqli_stmt_execute($stmt);

    $detail = mysqli_prepare($koneksi, 'INSERT INTO detail_transaksi (id_transaksi, id_menu, jumlah, subtotal) VALUES (?, ?, ?, ?)');
    foreach ($menuIds as $index => $idMenu) {
        $jumlah = (int) ($jumlahs[$index] ?? 0);
        $subtotal = (int) ($subtotals[$index] ?? 0);
        if ($idMenu === '' || $jumlah <= 0 || $subtotal <= 0) {
            continue;
        }
        mysqli_stmt_bind_param($detail, 'ssii', $idTransaksi, $idMenu, $jumlah, $subtotal);
        mysqli_stmt_execute($detail);
    }

    mysqli_commit($koneksi);
    set_flash('success', 'Transaksi berhasil disimpan.');
    header('Location: ' . base_url('index.php?page=transaksi_detail&id=' . $idTransaksi));
    exit;
} catch (Exception $e) {
    mysqli_rollback($koneksi);
    set_flash('error', $e->getMessage());
    header('Location: ' . base_url('index.php?page=transaksi'));
    exit;
}
?>
