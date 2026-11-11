<?php
// Pastikan koneksi database terpanggil
if (!isset($conn)) {
    include_once 'config/database.php';
}
?>
<div class="container my-4">
    <!-- Banner Foto Bagian Depan Panti (Setengah / Proporsional) -->
    <div class="card border-0 shadow-sm overflow-hidden text-center position-relative mb-4" style="height: 220px; border-radius: 8px;">
        <!-- Foto Depan Panti -->
        <img src="assets/images/bagian depan panti.jpeg" alt="Panti Asuhan Babul Jannah" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">

        <!-- Lapisan Gelap (Overlay) supaya teks putih terbaca jelas -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.45); z-index: 1;"></div>

        <!-- Konten Teks di Tengah -->
        <div class="card-body d-flex flex-column justify-content-center align-items-center p-3 position-relative text-white" style="z-index: 2;">
            <h3 class="fw-bold mb-1" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">KEGIATAN</h3>
            <p class="small m-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">Berbagai kegiatan pendidikan dan pembinaan anak-anak panti</p>
        </div>
    </div>

    <!-- Daftar Kegiatan -->
    <div class="row">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id DESC");
        if ($query && mysqli_num_rows($query) > 0):
            while ($row = mysqli_fetch_assoc($query)):
                $nama_foto = trim($row['foto'] ?? '');
                $path_foto = "assets/images/kegiatan/" . $nama_foto;
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm overflow-hidden">
                <?php if (!empty($nama_foto) && file_exists($path_foto)): ?>
                    <img src="<?php echo htmlspecialchars($path_foto); ?>" class="card-img-top" style="height: 190px; object-fit: cover;" alt="Foto Kegiatan">
                <?php else: ?>
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 190px;">Tidak Ada Foto</div>
                <?php endif; ?>
                
                <div class="card-body d-flex flex-column p-3">
                    <h5 class="card-title fw-bold text-success mb-1"><?php echo htmlspecialchars($row['judul'] ?? ''); ?></h5>
                    <p class="text-muted small mb-2"><i class="bi bi-calendar"></i> <?php echo htmlspecialchars($row['tanggal'] ?? ''); ?></p>
                </div>
            </div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada kegiatan yang dipublikasikan.</p>
        </div>
        <?php endif; ?>
    </div>
</div>