<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/functions.php';

if (empty($_SESSION['admin'])) {
    header('Location: ' . base_url('login.php'));
    exit;
}
?>
