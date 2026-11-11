-- =====================================================
-- DATABASE SISTEM INFORMASI PANTI ASUHAN BABUL JANNAH
-- Nama database: db_babul_jannah
-- =====================================================

CREATE DATABASE IF NOT EXISTS db_babul_jannah
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_babul_jannah;

-- Tabel akun administrator
CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Login awal: username admin | password admin123
-- Password disimpan dengan MD5 karena file admin/login.php proyek ini memakai md5().
INSERT INTO admin (username, password)
SELECT 'admin', MD5('admin123')
WHERE NOT EXISTS (SELECT 1 FROM admin WHERE username = 'admin');

-- Data kegiatan panti
CREATE TABLE IF NOT EXISTS kegiatan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(150) NOT NULL,
  tanggal DATE NOT NULL,
  deskripsi TEXT NULL,
  foto VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB;

-- Data foto galeri
CREATE TABLE IF NOT EXISTS galeri (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(150) NOT NULL,
  foto VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Formulir pendaftaran anak binaan
CREATE TABLE IF NOT EXISTS pendaftaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_lengkap VARCHAR(150) NOT NULL,
  nik VARCHAR(30) NOT NULL,
  tempat_lahir VARCHAR(100) NOT NULL,
  tanggal_lahir DATE NOT NULL,
  jenis_kelamin VARCHAR(20) NOT NULL,
  alamat TEXT NOT NULL,
  no_hp VARCHAR(30) NOT NULL,
  nama_ortu VARCHAR(150) NOT NULL,
  tanggal_daftar TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Konfirmasi donasi dari halaman publik
CREATE TABLE IF NOT EXISTS donasi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150) NOT NULL,
  nominal BIGINT NOT NULL,
  metode VARCHAR(100) NOT NULL,
  tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel konfirmasi_donasi dipakai pada hitungan rekap dashboard
CREATE TABLE IF NOT EXISTS konfirmasi_donasi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150) NOT NULL DEFAULT '',
  nominal BIGINT NOT NULL DEFAULT 0,
  metode VARCHAR(100) NOT NULL DEFAULT '',
  tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('Pending','Diterima','Ditolak') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB;

-- Pesan dari formulir kontak
CREATE TABLE IF NOT EXISTS pesan_kontak (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  pesan TEXT NOT NULL,
  tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('Belum Dibaca','Sudah Dibaca') NOT NULL DEFAULT 'Belum Dibaca'
) ENGINE=InnoDB;

-- Contoh data awal (opsional) agar halaman kegiatan dan galeri tidak kosong.
-- Nama file foto harus tersedia di assets/images/kegiatan/.
INSERT INTO kegiatan (judul, tanggal, deskripsi, foto)
SELECT 'Mengaji Bersama', CURDATE(), 'Kegiatan belajar membaca Al-Qur’an bersama anak-anak binaan.', 'mengaji bersama.jpeg'
WHERE NOT EXISTS (SELECT 1 FROM kegiatan WHERE judul = 'Mengaji Bersama');

INSERT INTO kegiatan (judul, tanggal, deskripsi, foto)
SELECT 'Sholat Bersama', CURDATE(), 'Kegiatan pembiasaan ibadah sholat bersama.', 'sholat bersama.jpeg'
WHERE NOT EXISTS (SELECT 1 FROM kegiatan WHERE judul = 'Sholat Bersama');

INSERT INTO galeri (judul, foto)
SELECT 'Mengaji Bersama', 'mengaji bersama.jpeg'
WHERE NOT EXISTS (SELECT 1 FROM galeri WHERE judul = 'Mengaji Bersama');

INSERT INTO galeri (judul, foto)
SELECT 'Sholat Bersama', 'sholat bersama.jpeg'
WHERE NOT EXISTS (SELECT 1 FROM galeri WHERE judul = 'Sholat Bersama');

-- =====================================================
-- SELESAI
-- =====================================================
