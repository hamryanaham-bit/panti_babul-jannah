<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include_once '../config/database.php';

// Proses Hapus Pendaftaran
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pendaftaran WHERE id='$id'");
    header("Location: pendaftaran.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background-color: #145a32; min-height: 100vh; }
        .sidebar a { color: white; text-decoration: none; padding: 12px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background-color: #1e8449; }
        .sidebar-logo { width: 65px; height: 65px; object-fit: cover; border-radius: 50%; border: 2px solid white; }
        .admin-logo { width: 40px; height: 40px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-3" style="width: 250px;">
        <div class="text-center mb-4 text-white">
            <img src="../assets/images/logo.jpeg" alt="Logo" class="sidebar-logo mb-2">
            <h5 class="fw-bold m-0">BABUL JANNAH</h5>
        </div>
        <a href="dashboard.php">Dashboard</a>
        <a href="kelola_kegiatan.php">Kelola Kegiatan</a>
        <a href="kelola_galeri.php">Kelola Galeri</a>
        <a href="notifikasi_donasi.php">Notifikasi Donasi</a>
        <a href="pendaftaran.php" class="active">Data Pendaftaran</a>
        <a href="pesan_kontak.php">Pesan Masuk</a>
        <hr class="text-white">
        <a href="../index.php" target="_blank">🌐 Lihat Website Utama</a>
        <a href="logout.php" class="bg-danger mt-3 text-center rounded">Logout</a>
    </div>

    <div class="p-4 flex-grow-1">
        <div class="card p-3 mb-4 border-0 shadow-sm d-flex flex-row justify-content-between align-items-center" style="background-color: #ffffff !important;">
            <h3 class="text-success fw-bold m-0">DATA PENDAFTARAN</h3>
            <div class="d-flex align-items-center">
                <span class="fw-bold me-2 text-dark">Admin</span>
                <img src="../assets/images/logo.jpeg" alt="Logo" class="admin-logo">
            </div>
        </div>

        <!-- Tabel Daftar Pendaftaran -->
        <div class="card p-4 border-0 shadow-sm bg-white">
            <h5 class="fw-bold text-dark mb-3">Daftar Anak / Calon Pendaftar</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Wali / Ortu</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $q = mysqli_query($conn, "SELECT * FROM pendaftaran ORDER BY id DESC");
                        if ($q && mysqli_num_rows($q) > 0):
                            while ($r = mysqli_fetch_assoc($q)): 
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="fw-bold"><?php echo htmlspecialchars($r['nama_lengkap']); ?></td>
                            <td class="text-center">
                                <?php 
                                    $tempat = !empty($r['tempat_lahir']) ? htmlspecialchars($r['tempat_lahir']) : '-';
                                    $tgl    = !empty($r['tanggal_lahir']) ? htmlspecialchars($r['tanggal_lahir']) : '-';
                                    echo $tempat . ', ' . $tgl;
                                ?>
                            </td>
                            <td class="text-center"><?php echo htmlspecialchars($r['jenis_kelamin']); ?></td>
                            <td><?php echo !empty($r['nama_ortu']) ? htmlspecialchars($r['nama_ortu']) : '-'; ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($r['no_hp']); ?></td>
                            <td class="text-center">
                                <a href="pendaftaran.php?hapus=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data pendaftaran ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data pendaftaran.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>