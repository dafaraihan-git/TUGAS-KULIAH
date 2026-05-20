<?php $current = $_GET['page'] ?? 'dashboard'; ?>
<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-profile">
        <div class="profile-icon"><i class="bi bi-person-badge"></i></div>
        <div>
            <div class="fw-semibold"><?= e($_SESSION['admin']['nama']); ?></div>
            <small>Administrator</small>
        </div>
    </div>
    <nav class="sidebar-menu">
        <a class="<?= $current === 'dashboard' ? 'active' : ''; ?>" href="<?= base_url('index.php'); ?>">
            <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
        </a>
        <a class="<?= str_starts_with($current, 'menu') ? 'active' : ''; ?>" href="<?= base_url('index.php?page=menu'); ?>">
            <i class="bi bi-card-list"></i><span>Menu</span>
        </a>
        <a class="<?= str_starts_with($current, 'transaksi') ? 'active' : ''; ?>" href="<?= base_url('index.php?page=transaksi'); ?>">
            <i class="bi bi-cash-coin"></i><span>Transaksi</span>
        </a>
        <a class="<?= str_starts_with($current, 'bahan_baku') ? 'active' : ''; ?>" href="<?= base_url('index.php?page=bahan_baku'); ?>">
            <i class="bi bi-box-seam"></i><span>Bahan Baku</span>
        </a>
        <a class="<?= str_starts_with($current, 'pelanggan') ? 'active' : ''; ?>" href="<?= base_url('index.php?page=pelanggan'); ?>">
            <i class="bi bi-people"></i><span>Pelanggan</span>
        </a>
        <a class="<?= str_starts_with($current, 'pegawai') ? 'active' : ''; ?>" href="<?= base_url('index.php?page=pegawai'); ?>">
            <i class="bi bi-person-workspace"></i><span>Pegawai</span>
        </a>
        <a class="<?= str_starts_with($current, 'laporan') ? 'active' : ''; ?>" href="<?= base_url('index.php?page=laporan'); ?>">
            <i class="bi bi-file-earmark-bar-graph"></i><span>Laporan</span>
        </a>
    </nav>
</aside>
