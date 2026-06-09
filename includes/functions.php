<?php
function base_url($path = '')
{
    $root = '/sistem-penjualan-ayam-ungkep';
    return $root . ($path ? '/' . ltrim($path, '/') : '');
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function rupiah($angka)
{
    return 'Rp ' . number_format((float) $angka, 0, ',', '.');
}

function set_flash($type, $message)
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash()
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function next_id($koneksi, $table, $column, $prefix, $length = 3)
{
    $sql = "SELECT $column AS kode FROM $table ORDER BY $column DESC LIMIT 1";
    $result = mysqli_query($koneksi, $sql);
    $row = $result ? mysqli_fetch_assoc($result) : null;
    $number = $row ? (int) substr($row['kode'], strlen($prefix)) + 1 : 1;

    return $prefix . str_pad((string) $number, $length, '0', STR_PAD_LEFT);
}

function upload_gambar_menu($fieldName = 'gambar')
{
    if (empty($_FILES[$fieldName]['name'])) {
        return null;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $fileName = $_FILES[$fieldName]['name'];
    $tmpName = $_FILES[$fieldName]['tmp_name'];
    $size = $_FILES[$fieldName]['size'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed, true)) {
        throw new Exception('Format gambar harus JPG, JPEG, PNG, atau WEBP.');
    }

    if ($size > 2 * 1024 * 1024) {
        throw new Exception('Ukuran gambar maksimal 2 MB.');
    }

    $safeName = 'menu_' . time() . '_' . random_int(100, 999) . '.' . $ext;
    $target = __DIR__ . '/../assets/img/menu/' . $safeName;

    if (!move_uploaded_file($tmpName, $target)) {
        throw new Exception('Upload gambar gagal.');
    }

    return $safeName;
}
?>
