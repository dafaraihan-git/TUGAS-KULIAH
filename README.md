# FINTRACK  
## 💰 Sistem Informasi Manajemen Keuangan Pribadi Berbasis Web 💰

---

## 🌐 Tentang Aplikasi

FinTrack adalah aplikasi berbasis web yang digunakan untuk membantu pengguna dalam mengelola dan memantau keuangan pribadi secara terstruktur dan efisien. Aplikasi ini menyediakan fitur pencatatan pemasukan dan pengeluaran, pengelompokan kategori keuangan, serta visualisasi arus kas dalam bentuk grafik sehingga pengguna dapat memahami kondisi finansialnya dengan lebih baik.

Selain itu, FinTrack dirancang dengan arsitektur RESTful API yang memungkinkan sistem untuk dikembangkan dan diintegrasikan dengan aplikasi lain di masa mendatang.

---

## 💡 Fitur Utama

- 🔐 Autentikasi pengguna (Login & Register)
- 📊 Dashboard ringkasan keuangan (saldo, pemasukan, pengeluaran)
- 💵 Manajemen data transaksi keuangan (CRUD)
- 🗂️ Manajemen kategori pemasukan dan pengeluaran
- 📈 Visualisasi arus kas bulanan
- 🔗 RESTful API untuk pertukaran data

---

## ⚙️ Teknologi yang Digunakan

- **Frontend** : HTML, CSS, JavaScript  
- **Backend** : PHP (Laravel Framework)  
- **Database** : MySQL  
- **Server** : Apache  
- **API** : RESTful API  

---

## 🗃️ Struktur Folder

📂 fintrack-laravel  
┣ 📂 api              → Endpoint RESTful API  
┣ 📂 aplikasi         → Logika dan fitur utama aplikasi  
┣ 📂 bootstrap        → Proses inisialisasi aplikasi  
┣ 📂 konfigurasi      → File konfigurasi sistem  
┣ 📂 basis_data       → Struktur dan pengelolaan database  
┣ 📂 publik           → Aset publik (CSS, JavaScript, gambar)  
┣ 📂 sumber_daya      → Tampilan (views) aplikasi  
┣ 📂 rute             → Definisi routing aplikasi  
┣ 📂 penyimpanan      → Penyimpanan file dan cache  
┣ 📂 tes              → File pengujian sistem  
┣ 📄 .editorconfig    → Konfigurasi editor  
┣ 📄 .gitignore       → Konfigurasi file yang diabaikan Git  
┣ 📄 .vercelignore    → Konfigurasi ignore untuk deployment Vercel  
┣ 📄 README.md        → Dokumentasi aplikasi  
┣ 📄 composer.json    → Manajemen dependensi PHP  
┣ 📄 composer.lock    → Versi terkunci dependensi PHP  
┣ 📄 package.json     → Manajemen dependensi JavaScript  
┣ 📄 package-lock.json→ Versi terkunci dependensi JavaScript  
┣ 📄 phpunit.xml      → Konfigurasi pengujian PHP  
┣ 📄 postcss.config.js→ Konfigurasi PostCSS  
┣ 📄 tailwind.config.js → Konfigurasi Tailwind CSS  
┣ 📄 vite.config.js   → Konfigurasi Vite  
┣ 📄 vercel.json      → Konfigurasi deployment Vercel  
┗ 📦 vendor.zip       → Arsip dependensi vendor


---

## ⚙️ Alur Kerja Sistem

### 👥 PENGGUNA
1. Pengguna mengakses aplikasi melalui browser
2. Pengguna melakukan login atau registrasi akun
3. Sistem memverifikasi data pengguna melalui server
4. Pengguna diarahkan ke dashboard
5. Pengguna dapat:
   - Melihat ringkasan keuangan
   - Menambah, mengubah, dan menghapus transaksi
   - Mengelola kategori pemasukan dan pengeluaran
6. Data ditampilkan secara real-time melalui RESTful API

### 👨‍💻 ADMIN
1. Admin melakukan login ke dalam sistem
2. Admin mengakses dashboard pengelolaan data
3. Admin melakukan pengelolaan data pengguna, transaksi, dan kategori
4. Sistem mengirim dan menerima data melalui RESTful API
5. Perubahan data disimpan ke dalam database dan ditampilkan kembali ke sistem

---

## 📸 Dokumentasi RESTful API

RESTful API pada aplikasi **FinTrack** digunakan sebagai penghubung antara frontend dan backend untuk mengelola data keuangan pengguna. API ini menggunakan format response **JSON** dan dapat diakses oleh pihak lain untuk keperluan integrasi sistem.

---

### 🔗 Base URL
http://fintrack.wuaze.com/api

---

## 🔐 Autentikasi

### Login Pengguna
- **Method** : POST  
- **Endpoint** : `/login`  
- **Deskripsi** : Digunakan untuk autentikasi pengguna

**Request Body:**
```json
{
  "email": "user@email.com",
  "password": "password123"
}
```
**Response Sukses:**
```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "jwt_token_example"
}
```
### Registrasi Pengguna

- **Metode** : POST
- **Endpoint** : `/register`
- **Deskripsi** : Digunakan untuk pendaftaran akun baru

**Request Body:**
```json
{
  "name": "Nama Pengguna",
  "email": "user@email.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

---

## 💵 Transaksi

### Menampilkan Semua Transaksi

- **Metode** : GET
- **Endpoint** : `/transactions`
- **Deskripsi** : Mengambil seluruh data transaksi pengguna

**Response:**
```json
[
  {
    "id": 1,
    "tanggal": "2025-01-01",
    "deskripsi": "Gaji Bulanan",
    "kategori": "Gaji",
    "tipe": "pemasukan",
    "jumlah": 5000000
  }
]
```

### Menambah Transaksi

- **Metode** : POST
- **Endpoint** : `/transactions`

**Request Body:**
```json
{
  "tanggal": "2025-01-05",
  "deskripsi": "Makan Siang",
  "kategori_id": 2,
  "tipe": "pengeluaran",
  "jumlah": 25000
}
```

### Mengubah Transaksi

- **Metode** : PUT
- **Endpoint** : `/transactions/{id}`

### Menghapus Transaksi

- **Metode** : DELETE
- **Endpoint** : `/transactions/{id}`

---

## 🗂️ Kategori

### Menampilkan Semua Kategori

- **Metode** : GET
- **Endpoint** : `/categories`

### Menambah Kategori

- **Metode** : POST
- **Endpoint** : `/categories`

**Request Body:**
```json
{
  "nama_kategori": "Transportasi",
  "tipe": "pengeluaran"
}
```

---

## 📊 Dashboard

### Ringkasan Keuangan

- **Metode** : GET
- **Endpoint** : `/dashboard/summary`
- **Deskripsi** : Menampilkan total saldo, pemasukan, dan pengeluaran

**Response:**
```json
{
  "total_saldo": 19804000,
  "total_pemasukan": 21500000,
  "total_pengeluaran": 1696000
}
```
