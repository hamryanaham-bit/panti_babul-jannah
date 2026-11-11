<?php
session_start();
include_once 'config/database.php';

// Menentukan halaman yang sedang aktif
$page = isset($_GET['page']) ? $_GET['page'] : 'beranda';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panti Asuhan Babul Jannah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .bg-custom-green { background-color: #145a32 !important; }
        .navbar-brand img { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>

    <!-- Header / Navbar Utama -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom-green shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="index.php?page=beranda">
                <img src="assets/images/logo.jpeg" alt="Logo" class="me-2"> 
                <span>PANTI ASUHAN BABUL JANNAH</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link <?php echo ($page == 'beranda') ? 'active fw-bold' : ''; ?>" href="index.php?page=beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($page == 'profil') ? 'active fw-bold' : ''; ?>" href="index.php?page=profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($page == 'kegiatan') ? 'active fw-bold' : ''; ?>" href="index.php?page=kegiatan">Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($page == 'galeri') ? 'active fw-bold' : ''; ?>" href="index.php?page=galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($page == 'donasi') ? 'active fw-bold' : ''; ?>" href="index.php?page=donasi">Donasi</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($page == 'pendaftaran') ? 'active fw-bold' : ''; ?>" href="index.php?page=pendaftaran">Pendaftaran</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($page == 'kontak') ? 'active fw-bold' : ''; ?>" href="index.php?page=kontak">Kontak</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="admin/login.php" class="btn btn-light text-success fw-bold px-3">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Dinamis Halaman -->
    <main>
        <?php
        $file = "views/" . $page . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<div class='container my-5 text-center'><h3>Halaman tidak ditemukan.</h3></div>";
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2026 Panti Asuhan Babul Jannah. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>