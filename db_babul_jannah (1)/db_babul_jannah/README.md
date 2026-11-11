# SISTEM INFORMASI PANTI ASUHAN BABUL JANNAH

## 1. Deskripsi Proyek
Sistem Informasi Panti Asuhan Babul Jannah merupakan website yang dibuat untuk menyediakan informasi mengenai profil lembaga, sejarah, kegiatan, galeri, donasi, pendaftaran, dan kontak Panti Asuhan Babul Jannah.

Website ini memiliki dua bagian utama:
- **Halaman Publik:** dapat diakses oleh pengunjung untuk melihat informasi panti asuhan.
- **Halaman Admin:** digunakan oleh pengelola untuk mengelola informasi dan data website.

## 2. Tujuan
1. Mempermudah masyarakat memperoleh informasi tentang Panti Asuhan Babul Jannah.
2. Menampilkan profil, kegiatan, dan dokumentasi panti secara online.
3. Membantu pengelola mengelola konten website.
4. Menyediakan informasi donasi, pendaftaran, dan kontak lembaga.

## 3. Teknologi yang Digunakan
- HTML
- CSS
- JavaScript
- PHP Native
- MySQL
- Bootstrap 5
- Bootstrap Icons
- XAMPP sebagai server lokal

## 4. Struktur Direktori

```text
db_babul_jannah/
│
├── admin/
│   ├── dashboard.php
│   ├── kelola_galeri.php
│   ├── kelola_kegiatan.php
│   ├── login.php
│   ├── logout.php
│   ├── notifikasi_donasi.php
│   ├── pendaftaran.php
│   └── pesan_kontak.php
│
├── assets/
│   ├── css/
│   │   ├── admin.css
│   │   └── style.css
│   ├── images/
│   │   ├── kegiatan/
│   │   ├── logo.jpeg
│   │   ├── banner.jpeg
│   │   └── bagian depan panti.jpeg
│   └── js/
│       └── main.js
│
├── config/
│   └── database.php
│
├── includes/
│   ├── admin_footer.php
│   ├── admin_header.php
│   ├── footer.php
│   └── header.php
│
├── views/
│   ├── beranda.php
│   ├── donasi.php
│   ├── galeri.php
│   ├── kegiatan.php
│   ├── kontak.php
│   ├── pendaftaran.php
│   └── profil.php
│
├── index.php
└── README.md
```

## 5. Persiapan Database
Nama database yang digunakan dalam konfigurasi proyek:

```text
db_babul_jannah
```

Pengaturan koneksi database terdapat pada file `config/database.php` dengan konfigurasi lokal XAMPP:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_babul_jannah";
```

**Catatan:** File ZIP proyek yang diperiksa belum menyertakan file SQL untuk membuat tabel. Buat database bernama `db_babul_jannah` melalui phpMyAdmin, kemudian impor file SQL proyek yang sesuai agar seluruh fitur yang membutuhkan database dapat digunakan.

## 6. Cara Menjalankan Website
1. Instal dan buka aplikasi XAMPP.
2. Jalankan **Apache** dan **MySQL**.
3. Ekstrak folder `db_babul_jannah`.
4. Salin folder tersebut ke direktori:

   ```text
   C:\xampp\htdocs\
   ```

5. Buka browser dan akses phpMyAdmin:

   ```text
   http://localhost/phpmyadmin
   ```

6. Buat database dengan nama `db_babul_jannah`.
7. Impor file SQL database yang sesuai.
8. Buka halaman utama website:

   ```text
   http://localhost/db_babul_jannah/
   ```

9. Untuk membuka halaman login admin, akses:

   ```text
   http://localhost/db_babul_jannah/admin/login.php
   ```

Gunakan akun admin yang telah dibuat di database atau melalui mekanisme login proyek.

## 7. Fitur Website

### Halaman Publik
- Beranda
- Profil dan sejarah panti
- Kegiatan
- Galeri foto
- Informasi donasi
- Pendaftaran
- Kontak

### Halaman Admin
- Login dan logout admin
- Dashboard admin
- Pengelolaan kegiatan
- Pengelolaan galeri
- Informasi pendaftaran
- Notifikasi donasi
- Pesan kontak

## 8. Pengembang
**Nama Proyek:** Sistem Informasi Panti Asuhan Babul Jannah  
**Mata Kuliah:** Project Mandiri  
**Program Studi:** Teknologi Rekayasa Multimedia  
**Fakultas:** Fakultas Teknik  
**Perguruan Tinggi:** Politeknik Dewantara Palopo  

## 9. Penutup
Website Sistem Informasi Panti Asuhan Babul Jannah diharapkan dapat membantu penyampaian informasi kepada masyarakat serta mendukung pengelolaan informasi lembaga secara lebih terstruktur dan mudah diakses.
