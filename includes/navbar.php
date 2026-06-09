<nav class="navbar navbar-expand-lg fixed-top app-navbar">
    <div class="container-fluid">
        <button class="btn btn-link text-white d-lg-none me-2" id="sidebarToggle" type="button">
            <i class="bi bi-list fs-3"></i>
        </button>
        <a class="navbar-brand fw-bold text-white" href="<?= base_url('index.php'); ?>">
            <i class="bi bi-shop-window me-2"></i>Ayam Ungkep
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white-50 d-none d-sm-inline">Halo, <?= e($_SESSION['admin']['nama']); ?></span>
            <a href="<?= base_url('logout.php'); ?>" class="btn btn-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>
