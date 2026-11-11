<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include_once '../config/database.php';

// Proses Tambah Galeri
if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    
    if (!empty($foto)) {
        $foto_baru = time() . '_' . basename($foto);
        move_uploaded_file($tmp, "../assets/images/kegiatan/" . $foto_baru);
        mysqli_query($conn, "INSERT INTO galeri (judul, foto) VALUES ('$judul', '$foto_baru')");
    }
    header("Location: kelola_galeri.php");
    exit;
}

// Proses Edit Galeri
if (isset($_POST['edit'])) {
    $id    = $_POST['id'];
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    
    if (!empty($foto)) {
        $foto_baru = time() . '_' . basename($foto);
        move_uploaded_file($tmp, "../assets/images/kegiatan/" . $foto_baru);
        $q_lama = mysqli_query($conn, "SELECT foto FROM galeri WHERE id='$id'");
        $d_lama = mysqli_fetch_assoc($q_lama);
        if (!empty($d_lama['foto']) && file_exists("../assets/images/kegiatan/" . $d_lama['foto'])) {
            unlink("../assets/images/kegiatan/" . $d_lama['foto']);
        }
        mysqli_query($conn, "UPDATE galeri SET judul='$judul', foto='$foto_baru' WHERE id='$id'");
    } else {
        mysqli_query($conn, "UPDATE galeri SET judul='$judul' WHERE id='$id'");
    }
    header("Location: kelola_galeri.php");
    exit;
}

// Proses Hapus Galeri
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $q_lama = mysqli_query($conn, "SELECT foto FROM galeri WHERE id='$id'");
    $d_lama = mysqli_fetch_assoc($q_lama);
    if (!empty($d_lama['foto']) && file_exists("../assets/images/kegiatan/" . $d_lama['foto'])) {
        unlink("../assets/images/kegiatan/" . $d_lama['foto']);
    }
    mysqli_query($conn, "DELETE FROM galeri WHERE id='$id'");
    header("Location: kelola_galeri.php");
    exit;
}

// Ambil data untuk diedit jika ada parameter ubah
$edit_data = null;
if (isset($_GET['ubah'])) {
    $id_ubah = $_GET['ubah'];
    $q_ubah = mysqli_query($conn, "SELECT * FROM galeri WHERE id='$id_ubah'");
    $edit_data = mysqli_fetch_assoc($q_ubah);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri - Admin</title>
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
        <a href="kelola_galeri.php" class="active">Kelola Galeri</a>
        <a href="notifikasi_donasi.php">Notifikasi Donasi</a>
        <a href="pendaftaran.php">Data Pendaftaran</a>
        <a href="pesan_kontak.php">Pesan Masuk</a>
        <hr class="text-white">
        <a href="../index.php" target="_blank">🌐 Lihat Website Utama</a>
        <a href="logout.php" class="bg-danger mt-3 text-center rounded">Logout</a>
    </div>

    <div class="p-4 flex-grow-1">
        <div class="card p-3 mb-4 border-0 shadow-sm d-flex flex-row justify-content-between align-items-center" style="background-color: #ffffff !important;">
            <h3 class="text-success fw-bold m-0">KELOLA GALERI FOTO</h3>
            <div class="d-flex align-items-center">
                <span class="fw-bold me-2 text-dark">Admin</span>
                <img src="../assets/images/logo.jpeg" alt="Logo" class="admin-logo">
            </div>
        </div>

        <!-- Form Tambah / Edit Galeri -->
        <div class="card p-4 border-0 shadow-sm bg-white mb-4">
            <h5 class="fw-bold text-success mb-3"><?php echo $edit_data ? 'Edit Foto Galeri' : 'Tambah Foto Galeri Baru'; ?></h5>
            <form action="kelola_galeri.php" method="POST" enctype="multipart/form-data">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul / Keterangan Foto</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo $edit_data['judul'] ?? ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">File Foto <?php echo $edit_data ? '(Biarkan kosong jika tidak ingin mengubah foto)' : ''; ?></label>
                    <input type="file" name="foto" class="form-control" <?php echo $edit_data ? '' : 'required'; ?>>
                </div>
                <?php if ($edit_data): ?>
                    <button type="submit" name="edit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                    <a href="kelola_galeri.php" class="btn btn-secondary px-3">Batal</a>
                <?php else: ?>
                    <button type="submit" name="tambah" class="btn btn-success fw-bold px-4">Upload Foto</button>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabel Daftar Galeri -->
        <div class="card p-4 border-0 shadow-sm bg-white">
            <h5 class="fw-bold text-dark mb-3">Daftar Foto Galeri</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul / Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $q = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
                        if ($q && mysqli_num_rows($q) > 0):
                            while ($r = mysqli_fetch_assoc($q)): 
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center">
                                <?php if (!empty($r['foto']) && file_exists("../assets/images/kegiatan/" . $r['foto'])): ?>
                                    <img src="../assets/images/kegiatan/<?php echo htmlspecialchars($r['foto']); ?>" style="width: 90px; height: 60px; object-fit: cover; border-radius: 4px;">
                                <?php else: ?>
                                    <span class="text-muted small">No Photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?php echo htmlspecialchars($r['judul']); ?></td>
                            <td class="text-center">
                                <a href="kelola_galeri.php?ubah=<?php echo $r['id']; ?>" class="btn btn-warning btn-sm text-white mb-1">Edit</a>
                                <a href="kelola_galeri.php?hapus=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus foto ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada foto di galeri.</td>
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