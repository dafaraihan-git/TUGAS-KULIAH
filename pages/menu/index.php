<?php
$menus = mysqli_query($koneksi, "
    SELECT m.*, k.nama_kategori
    FROM menu m
    LEFT JOIN kategori_menu k ON k.id_kategori = m.id_kategori
    ORDER BY m.id_menu DESC
");
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="page-title h3 mb-1">Data Menu</h1>
        <p class="text-muted mb-0">Kelola menu ayam ungkep, kategori, harga, dan gambar.</p>
    </div>
    <a class="btn btn-orange" href="<?= base_url('index.php?page=menu_tambah'); ?>"><i class="bi bi-plus-circle me-1"></i>Tambah Menu</a>
</div>

<div class="card content-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($menus)): ?>
                    <tr>
                        <td>
                            <?php if (!empty($row['gambar'])): ?>
                                <img class="menu-thumb" src="<?= base_url('assets/img/menu/' . $row['gambar']); ?>" alt="<?= e($row['nama_menu']); ?>">
                            <?php else: ?>
                                <div class="menu-thumb d-grid place-items-center text-center small text-muted">No Image</div>
                            <?php endif; ?>
                        </td>
                        <td><?= e($row['id_menu']); ?></td>
                        <td><span class="badge badge-soft"><?= e($row['nama_kategori']); ?></span></td>
                        <td class="fw-semibold"><?= e($row['nama_menu']); ?></td>
                        <td><?= rupiah($row['harga']); ?></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="<?= base_url('index.php?page=menu_edit&id=' . $row['id_menu']); ?>"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-sm btn-outline-danger btn-delete" href="<?= base_url('index.php?page=menu_hapus&id=' . $row['id_menu']); ?>"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
