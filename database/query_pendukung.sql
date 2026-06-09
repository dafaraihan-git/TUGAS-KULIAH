-- Query statistik dashboard
SELECT COUNT(*) AS total_menu FROM menu;
SELECT COUNT(*) AS total_transaksi FROM transaksi;
SELECT COUNT(*) AS total_pelanggan FROM pelanggan;
SELECT COALESCE(SUM(total_harga), 0) AS total_pendapatan FROM transaksi;

-- Query grafik penjualan per tanggal
SELECT tanggal, SUM(total_harga) AS total
FROM transaksi
GROUP BY tanggal
ORDER BY tanggal ASC;

-- Query data menu dengan kategori
SELECT m.id_menu, k.nama_kategori, m.nama_menu, m.harga, m.gambar
FROM menu m
LEFT JOIN kategori_menu k ON k.id_kategori = m.id_kategori;

-- Query bahan baku dengan supplier
SELECT b.id_bahan, b.nama_bahan, b.stok, b.satuan, s.nama_supplier
FROM bahan_baku b
LEFT JOIN supplier s ON s.id_supplier = b.id_supplier;

-- Query laporan dari view
SELECT *
FROM laporan_penjualan
WHERE tanggal BETWEEN '2026-05-01' AND '2026-05-31'
ORDER BY tanggal DESC;
