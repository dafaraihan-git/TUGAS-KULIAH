# Sistem Penjualan Ayam Ungkep

Website kasir dan manajemen penjualan ayam ungkep menggunakan PHP Native, MySQL, Bootstrap 5, DataTables, SweetAlert, Bootstrap Icons, dan Chart.js.

## Fitur

- Login admin dan proteksi halaman dengan session.
- Dashboard statistik: total menu, transaksi, pelanggan, pendapatan.
- Grafik penjualan sederhana menggunakan Chart.js.
- CRUD menu dengan kategori, harga, dan upload gambar.
- CRUD bahan baku dengan supplier dan stok.
- CRUD pelanggan.
- CRUD pegawai.
- Transaksi kasir: pilih pelanggan, pegawai, menu, jumlah, subtotal otomatis, total otomatis.
- Detail transaksi tersimpan ke `detail_transaksi`, sehingga trigger database mengurangi stok bahan otomatis.
- Laporan penjualan dari view `laporan_penjualan`, filter tanggal, print, dan save PDF lewat browser.

## Instalasi XAMPP

1. Buat folder project di `C:\xampp\htdocs\sistem-penjualan-ayam-ungkep`.
2. Pindahkan semua file project ini ke folder tersebut.
3. Jalankan Apache dan MySQL dari XAMPP Control Panel.
4. Buka phpMyAdmin: `http://localhost/phpmyadmin`.
5. Buat database bernama `db_penjualan_ayam_ungkep`.
6. Import file database utama: `C:\Users\HYPE AMD\Downloads\db_penjualan_ayam_ungkep.sql`.
7. Import file tambahan project: `database/update_aplikasi.sql`.
8. Buka website: `http://localhost/sistem-penjualan-ayam-ungkep/login.php`.
9. Login default: username `admin`, password `admin123`.

## Struktur Folder

```text
config/
  koneksi.php
assets/
  css/style.css
  js/app.js
  img/menu/
includes/
  auth.php
  functions.php
  navbar.php
  sidebar.php
  footer.php
pages/
  dashboard.php
  menu/
  transaksi/
  bahan_baku/
  laporan/
  pelanggan/
  pegawai/
database/
  update_aplikasi.sql
  query_pendukung.sql
index.php
login.php
logout.php
```

## ERD Sederhana

`kategori_menu` memiliki banyak `menu`. Setiap `menu` bisa memiliki beberapa komposisi pada `resep_menu`. `resep_menu` menghubungkan `menu` dengan `bahan_baku`, sehingga sistem tahu bahan apa saja yang digunakan oleh sebuah menu. `bahan_baku` terhubung ke `supplier`.

`pelanggan` dan `pegawai` terhubung ke `transaksi`. Satu transaksi memiliki banyak `detail_transaksi`. Setiap detail transaksi menunjuk ke satu `menu`. Saat detail transaksi ditambahkan, trigger `kurangi_stok_bahan` mengurangi stok bahan berdasarkan resep menu.

## Alur Transaksi

1. Admin login ke sistem.
2. Kasir membuka menu Transaksi.
3. Kasir memilih tanggal, pelanggan, pegawai, metode pembayaran, menu, dan jumlah.
4. JavaScript menghitung subtotal dan total otomatis.
5. Sistem menyimpan data ke tabel `transaksi`.
6. Sistem menyimpan item ke tabel `detail_transaksi`.
7. Trigger database otomatis mengurangi stok di tabel `bahan_baku`.
8. Kasir dapat melihat detail transaksi dan mencetak struk.

## Catatan

- Project memakai procedural PHP dan mysqli agar mudah dipahami mahasiswa semester awal.
- Upload gambar menu disimpan ke `assets/img/menu`.
- Jika nama folder project di `htdocs` diganti, ubah nilai `$root` pada `includes/functions.php`.
