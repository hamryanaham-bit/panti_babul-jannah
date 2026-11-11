<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include_once '../config/database.php';

// Proses Tambah Kegiatan
if (isset($_POST['tambah'])) {
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    
    if (!empty($foto)) {
        $foto_baru = time() . '_' . basename($foto);
        move_uploaded_file($tmp, "../assets/images/kegiatan/" . $foto_baru);
        mysqli_query($conn, "INSERT INTO kegiatan (judul, tanggal, deskripsi, foto) VALUES ('$judul', '$tanggal', '', '$foto_baru')");
    } else {
        mysqli_query($conn, "INSERT INTO kegiatan (judul, tanggal, deskripsi, foto) VALUES ('$judul', '$tanggal', '', '')");
    }
    header("Location: kelola_kegiatan.php");
    exit;
}

// Proses Edit Kegiatan
if (isset($_POST['edit'])) {
    $id      = $_POST['id'];
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    
    if (!empty($foto)) {
        $foto_baru = time() . '_' . basename($foto);
        move_uploaded_file($tmp, "../assets/images/kegiatan/" . $foto_baru);
        // Hapus foto lama jika ada
        $q_lama = mysqli_query($conn, "SELECT foto FROM kegiatan WHERE id='$id'");
        $d_lama = mysqli_fetch_assoc($q_lama);
        if (!empty($d_lama['foto']) && file_exists("../assets/images/kegiatan/" . $d_lama['foto'])) {
            unlink("../assets/images/kegiatan/" . $d_lama['foto']);
        }
        mysqli_query($conn, "UPDATE kegiatan SET judul='$judul', tanggal='$tanggal', foto='$foto_baru' WHERE id='$id'");
    } else {
        mysqli_query($conn, "UPDATE kegiatan SET judul='$judul', tanggal='$tanggal' WHERE id='$id'");
    }
    header("Location: kelola_kegiatan.php");
    exit;
}

// Proses Hapus Kegiatan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $q_lama = mysqli_query($conn, "SELECT foto FROM kegiatan WHERE id='$id'");
    $d_lama = mysqli_fetch_assoc($q_lama);
    if (!empty($d_lama['foto']) && file_exists("../assets/images/kegiatan/" . $d_lama['foto'])) {
        unlink("../assets/images/kegiatan/" . $d_lama['foto']);
    }
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id='$id'");
    header("Location: kelola_kegiatan.php");
    exit;
}

// Ambil data untuk diedit jika parameter edit ada
$edit_data = null;
if (isset($_GET['ubah'])) {
    $id_ubah = $_GET['ubah'];
    $q_ubah = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id='$id_ubah'");
    $edit_data = mysqli_fetch_assoc($q_ubah);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan - Admin</title>
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
        <a href="kelola_kegiatan.php" class="active">Kelola Kegiatan</a>
        <a href="kelola_galeri.php">Kelola Galeri</a>
        <a href="notifikasi_donasi.php">Notifikasi Donasi</a>
        <a href="pendaftaran.php">Data Pendaftaran</a>
        <a href="pesan_kontak.php">Pesan Masuk</a>
        <hr class="text-white">
        <a href="../index.php" target="_blank">🌐 Lihat Website Utama</a>
        <a href="logout.php" class="bg-danger mt-3 text-center rounded">Logout</a>
    </div>

    <div class="p-4 flex-grow-1">
        <div class="card p-3 mb-4 border-0 shadow-sm d-flex flex-row justify-content-between align-items-center" style="background-color: #ffffff !important;">
            <h3 class="text-success fw-bold m-0">KELOLA KEGIATAN</h3>
            <div class="d-flex align-items-center">
                <span class="fw-bold me-2 text-dark">Admin</span>
                <img src="../assets/images/logo.jpeg" alt="Logo" class="admin-logo">
            </div>
        </div>

        <!-- Form Tambah / Edit Kegiatan -->
        <div class="card p-4 border-0 shadow-sm bg-white mb-4">
            <h5 class="fw-bold text-success mb-3"><?php echo $edit_data ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru'; ?></h5>
            <form action="kelola_kegiatan.php" method="POST" enctype="multipart/form-data">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Kegiatan</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($edit_data['judul'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?php echo htmlspecialchars($edit_data['tanggal'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Foto Kegiatan <?php echo $edit_data ? '(Biarkan kosong jika tidak ingin mengubah foto)' : ''; ?></label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <?php if ($edit_data): ?>
                    <button type="submit" name="edit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                    <a href="kelola_kegiatan.php" class="btn btn-secondary px-3">Batal</a>
                <?php else: ?>
                    <button type="submit" name="tambah" class="btn btn-success fw-bold px-4">Tambah Kegiatan</button>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabel Daftar Kegiatan -->
        <div class="card p-4 border-0 shadow-sm bg-white">
            <h5 class="fw-bold text-dark mb-3">Daftar Kegiatan</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $q = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id DESC");
                        if ($q && mysqli_num_rows($q) > 0):
                            while ($r = mysqli_fetch_assoc($q)): 
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center">
                                <?php if (!empty($r['foto']) && file_exists("../assets/images/kegiatan/" . $r['foto'])): ?>
                                    <img src="../assets/images/kegiatan/<?php echo htmlspecialchars($r['foto']); ?>" style="width: 70px; height: 50px; object-fit: cover; border-radius: 4px;">
                                <?php else: ?>
                                    <span class="text-muted small">No Photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?php echo htmlspecialchars($r['judul']); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($r['tanggal']); ?></td>
                            <td class="text-center">
                                <a href="kelola_kegiatan.php?ubah=<?php echo $r['id']; ?>" class="btn btn-warning btn-sm text-white mb-1">Edit</a>
                                <a href="kelola_kegiatan.php?hapus=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kegiatan ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data kegiatan.</td>
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