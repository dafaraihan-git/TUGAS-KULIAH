<?php
$pelanggan = mysqli_query($koneksi, 'SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC');
$pegawai = mysqli_query($koneksi, 'SELECT * FROM pegawai ORDER BY nama_pegawai ASC');
$menu = mysqli_query($koneksi, 'SELECT * FROM menu ORDER BY nama_menu ASC');
$menus = [];
while ($row = mysqli_fetch_assoc($menu)) {
    $menus[] = $row;
}
$riwayat = mysqli_query($koneksi, "
    SELECT t.*, p.nama_pelanggan, pg.nama_pegawai
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id_pelanggan = t.id_pelanggan
    LEFT JOIN pegawai pg ON pg.id_pegawai = t.id_pegawai
    ORDER BY t.id_transaksi DESC
");
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="page-title h3 mb-1">Transaksi Kasir</h1>
        <p class="text-muted mb-0">Pilih menu, jumlah, lalu simpan transaksi.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-7">
        <div class="card content-card">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Input Transaksi</h2>
                <form method="post" action="<?= base_url('index.php?page=transaksi_simpan'); ?>" id="formTransaksi">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pelanggan</label>
                            <select name="id_pelanggan" class="form-select" required>
                                <option value="">Pilih</option>
                                <?php mysqli_data_seek($pelanggan, 0); while ($row = mysqli_fetch_assoc($pelanggan)): ?>
                                    <option value="<?= e($row['id_pelanggan']); ?>"><?= e($row['nama_pelanggan']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pegawai</label>
                            <select name="id_pegawai" class="form-select" required>
                                <option value="">Pilih</option>
                                <?php while ($row = mysqli_fetch_assoc($pegawai)): ?>
                                    <option value="<?= e($row['id_pegawai']); ?>"><?= e($row['nama_pegawai']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select" required>
                                <option>Cash</option>
                                <option>QRIS</option>
                                <option>Debit</option>
                            </select>
                        </div>
                    </div>

                    <div id="itemWrapper" class="vstack gap-2 mb-3"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="addItem"><i class="bi bi-plus-circle me-1"></i>Tambah Item</button>

                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <div class="text-muted">Total Pembayaran</div>
                        <input type="hidden" name="total_harga" id="totalHarga" value="0">
                        <div class="fs-4 fw-bold text-danger" id="totalLabel">Rp 0</div>
                    </div>
                    <button class="btn btn-orange w-100 mt-3" type="submit"><i class="bi bi-check-circle me-1"></i>Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="card content-card">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Riwayat</h2>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle datatable">
                        <thead><tr><th>ID</th><th>Tanggal</th><th>Total</th><th></th></tr></thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($riwayat)): ?>
                            <tr>
                                <td class="fw-semibold"><?= e($row['id_transaksi']); ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                <td><?= rupiah($row['total_harga']); ?></td>
                                <td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="<?= base_url('index.php?page=transaksi_detail&id=' . $row['id_transaksi']); ?>"><i class="bi bi-eye"></i></a></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<template id="itemTemplate">
    <div class="kasir-row item-row">
        <div>
            <label class="form-label small">Menu</label>
            <select name="id_menu[]" class="form-select menu-select" required>
                <option value="" data-harga="0">Pilih menu</option>
                <?php foreach ($menus as $item): ?>
                    <option value="<?= e($item['id_menu']); ?>" data-harga="<?= e($item['harga']); ?>"><?= e($item['nama_menu']); ?> - <?= rupiah($item['harga']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="form-label small">Jumlah</label>
            <input type="number" name="jumlah[]" class="form-control jumlah-input" value="1" min="1" required>
        </div>
        <div>
            <label class="form-label small">Subtotal</label>
            <input type="text" class="form-control subtotal-label" value="Rp 0" readonly>
            <input type="hidden" name="subtotal[]" class="subtotal-input" value="0">
        </div>
        <button type="button" class="btn btn-outline-danger remove-item"><i class="bi bi-x-lg"></i></button>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.getElementById('itemWrapper');
    const template = document.getElementById('itemTemplate');
    const totalHarga = document.getElementById('totalHarga');
    const totalLabel = document.getElementById('totalLabel');
    const addButton = document.getElementById('addItem');

    const formatRupiah = (angka) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(angka);

    function hitung() {
        let total = 0;
        wrapper.querySelectorAll('.item-row').forEach(row => {
            const menu = row.querySelector('.menu-select');
            const jumlah = parseInt(row.querySelector('.jumlah-input').value || '0', 10);
            const harga = parseInt(menu.options[menu.selectedIndex]?.dataset.harga || '0', 10);
            const subtotal = harga * jumlah;
            row.querySelector('.subtotal-input').value = subtotal;
            row.querySelector('.subtotal-label').value = formatRupiah(subtotal);
            total += subtotal;
        });
        totalHarga.value = total;
        totalLabel.textContent = formatRupiah(total);
    }

    function addRow() {
        wrapper.appendChild(template.content.cloneNode(true));
        hitung();
    }

    addButton.addEventListener('click', addRow);
    wrapper.addEventListener('input', hitung);
    wrapper.addEventListener('change', hitung);
    wrapper.addEventListener('click', function (event) {
        if (event.target.closest('.remove-item')) {
            event.target.closest('.item-row').remove();
            hitung();
        }
    });
    addRow();
});
</script>
