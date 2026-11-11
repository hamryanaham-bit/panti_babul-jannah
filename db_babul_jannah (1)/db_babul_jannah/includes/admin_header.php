<?php
session_start();
require_once '../config/database.php';

// Cek Notifikasi Pesan & Donasi Baru
$query_notif_pesan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pesan_kontak WHERE status='Belum Dibaca'");
$notif_pesan = mysqli_fetch_assoc($query_notif_pesan)['total'];

$query_notif_donasi = mysqli_query($conn, "SELECT COUNT(*) as total FROM konfirmasi_donasi WHERE status='Pending'");
$notif_donasi = mysqli_fetch_assoc($query_notif_donasi)['total'];

$total_notif = $notif_pesan + $notif_donasi;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Panti Asuhan Babul Jannah</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-wrapper">
        <!-- SIDEBAR ADMIN -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="../assets/images/logo.jpeg" alt="Logo">
                <h3>BABUL JANNAH</h3>
            </div>
            <nav class="sidebar-menu">
				<a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
				<a href="kelola_kegiatan.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'kelola_kegiatan.php' ? 'active' : ''; ?>">Kelola Kegiatan</a>
				<a href="kelola_galeri.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'kelola_galeri.php' ? 'active' : ''; ?>">Kelola Galeri</a>
				<a href="notifikasi_donasi.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'notifikasi_donasi.php' ? 'active' : ''; ?>">Notifikasi Donasi</a>
				<a href="pesan_kontak.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'pesan_kontak.php' ? 'active' : ''; ?>">Pesan Masuk</a>
    
    <!-- LINK PENGHUBUNG KEMBALI KE KEGIATAN PUBLIC -->
				<a href="../views/beranda.php" target="_blank" style="margin-top: 20px; background: rgba(255,255,255,0.1);">🌐 Lihat Website Utama</a>
				<a href="logout.php" class="logout-btn">Logout</a>
		</nav>
        </aside>

        <!-- MAIN CONTENT CONTAINER -->
        <main class="main-content">
            <header class="admin-topbar">
                <h2><?php echo isset($page_title) ? $page_title : 'DASHBOARD ADMIN'; ?></h2>
                <div class="user-profile">
                    <span>Admin</span>
                    <img src="../assets/images/logo.jpeg" alt="Admin Avatar" class="avatar">
                </div>
            </header>