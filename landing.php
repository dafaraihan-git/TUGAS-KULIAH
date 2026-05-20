<?php
require_once __DIR__ . '/includes/functions.php';
$waNumber = '6281234567890';
$waText = rawurlencode('Halo, saya ingin pesan Ayam Ungkep.');
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ayam Ungkep Bu Rasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css?v=' . filemtime(__DIR__ . '/assets/css/style.css')); ?>" rel="stylesheet">
</head>
<body class="landing-body">
<nav class="navbar navbar-dark navbar-expand-lg landing-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('landing.php'); ?>">
                <i class="bi bi-fire me-2"></i>Ayam Ungkep Bu Rasa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="landingNav">
                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <a class="nav-link" href="#menu">Menu</a>
                    <a class="nav-link" href="#promo">Promo</a>
                    <a class="nav-link" href="#lokasi">Lokasi</a>
                    <a class="btn btn-orange ms-lg-2" target="_blank" href="https://wa.me/<?= $waNumber; ?>?text=<?= $waText; ?>">
                        <i class="bi bi-whatsapp me-1"></i>Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <header class="customer-hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="landing-badge"><i class="bi bi-star-fill me-1"></i>Hangat, gurih, siap disantap</span>
                    <h1 class="display-4 fw-bold mt-4 mb-3">Ayam ungkep empuk dengan bumbu meresap sampai dalam</h1>
                    <p class="lead mb-4">
                        Pilihan ayam ungkep original, pedas, dan paket hemat untuk makan siang,
                        makan malam, atau acara keluarga.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a class="btn btn-orange btn-lg" target="_blank" href="https://wa.me/<?= $waNumber; ?>?text=<?= $waText; ?>">
                            <i class="bi bi-whatsapp me-2"></i>Pesan via WhatsApp
                        </a>
                        <a class="btn btn-light btn-lg" href="#menu">
                            <i class="bi bi-card-list me-2"></i>Lihat Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="landing-section" id="menu">
            <div class="container">
                <div class="section-heading text-center mb-5">
                    <span class="landing-badge">Menu Favorit</span>
                    <h2 class="fw-bold mt-3">Pilih menu ayam ungkep favoritmu</h2>
                </div>
                <div class="row g-3">
                    <div class="col-md-6 col-lg-3">
                        <div class="menu-public-card h-100">
                            <img src="https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?auto=format&fit=crop&w=700&q=80" alt="Ayam Ungkep Original">
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <h3>Ayam Ungkep Original</h3>
                                <p class="flex-grow-1">Bumbu gurih klasik, cocok untuk semua selera.</p>
                                <strong class="text-orange fs-5">Rp 18.000</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="menu-public-card h-100">
                            <img src="https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=700&q=80" alt="Ayam Ungkep Pedas">
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <h3>Ayam Ungkep Pedas</h3>
                                <p class="flex-grow-1">Pedas mantap dengan aroma rempah yang kuat.</p>
                                <strong class="text-orange fs-5">Rp 20.000</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="menu-public-card h-100">
                            <img src="https://images.unsplash.com/photo-1562967914-608f82629710?auto=format&fit=crop&w=700&q=80" alt="Paket Hemat Ayam">
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <h3>Paket Hemat Ayam</h3>
                                <p class="flex-grow-1">Ayam, nasi, sambal, dan minuman dalam satu paket.</p>
                                <strong class="text-orange fs-5">Rp 25.000</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="menu-public-card h-100">
                            <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=700&q=80" alt="Ayam Kampung Ungkep">
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <h3>Ayam Kampung Ungkep</h3>
                                <p class="flex-grow-1">Ayam kampung pilihan dengan tekstur khas dan bumbu meresap.</p>
                                <strong class="text-orange fs-5">Rp 35.000</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section bg-soft" id="promo">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=800&q=80" alt="Promo Ayam Ungkep" class="img-fluid rounded-4 shadow-lg">
                    </div>
                    <div class="col-lg-6">
                        <span class="landing-badge">Spesial Promo</span>
                        <h2 class="fw-bold mt-3 mb-4">Diskon 10% untuk pesanan di atas 5 porsi!</h2>
                        <p class="lead mb-4">Cocok banget untuk acara keluarga, arisan, atau syukuran. Pesan sekarang dan nikmati kelezatan ayam ungkep kami dengan harga lebih hemat.</p>
                        <a class="btn btn-orange btn-lg" target="_blank" href="https://wa.me/<?= $waNumber; ?>?text=<?= rawurlencode('Halo, saya tertarik dengan promo diskon 10% pesanan 5 porsi Ayam Ungkep.'); ?>">
                            Klaim Promo <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section" id="lokasi">
            <div class="container">
                <div class="section-heading text-center mb-5">
                    <span class="landing-badge">Lokasi Kami</span>
                    <h2 class="fw-bold mt-3">Kunjungi Kedai Kami</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="card content-card border-0">
                            <div class="card-body p-4 p-md-5">
                                <i class="bi bi-geo-alt-fill text-orange display-4 mb-3"></i>
                                <h3 class="fw-bold">Ayam Ungkep Bu Rasa</h3>
                                <p class="text-muted mb-4 fs-5">Jl. Kuliner Nikmat No. 123, Jakarta Selatan</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <div class="d-flex align-items-center"><i class="bi bi-clock me-2 text-orange"></i> Buka 09:00 - 21:00</div>
                                    <div class="d-flex align-items-center"><i class="bi bi-telephone me-2 text-orange"></i> 0812-3456-7890</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="landing-footer text-center py-4">
        <div class="container">
            <p class="mb-0 text-muted">&copy; <?= date('Y'); ?> Ayam Ungkep Bu Rasa. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.landing-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>