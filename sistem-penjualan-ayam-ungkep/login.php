<?php
session_start();
require_once __DIR__ . '/config/koneksi.php';
require_once __DIR__ . '/includes/functions.php';

if (!empty($_SESSION['admin'])) {
    header('Location: ' . base_url('index.php'));
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare($koneksi, 'SELECT id_admin, nama_admin, username, password FROM admin WHERE username = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = [
            'id' => $admin['id_admin'],
            'nama' => $admin['nama_admin'],
            'username' => $admin['username'],
        ];
        header('Location: ' . base_url('index.php'));
        exit;
    }

    $error = 'Username atau password salah.';
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Ayam Ungkep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body class="login-body">
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="login-logo"><i class="bi bi-shop"></i></div>
            <h1 class="h4 fw-bold mt-3 mb-1">Sistem Penjualan Ayam Ungkep</h1>
            <p class="text-muted mb-0">Masuk sebagai admin kasir</p>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= e($error); ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control form-control-lg" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" required>
            </div>
            <button class="btn btn-orange btn-lg w-100" type="submit">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
            <p class="text-center small text-muted mt-3 mb-0">Default: admin / admin123</p>
        </form>
    </div>
</body>
</html>
