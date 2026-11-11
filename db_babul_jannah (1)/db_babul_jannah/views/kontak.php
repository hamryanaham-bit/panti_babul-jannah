<?php
// Pastikan koneksi database terpanggil
if (!isset($conn)) {
    include_once 'config/database.php';
}

$pesan_sukses = "";

// Proses ketika tombol kirim pesan ditekan
if (isset($_POST['kirim_pesan'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $query_insert = mysqli_query($conn, "INSERT INTO pesan_kontak (nama, email, pesan, tanggal) VALUES ('$nama', '$email', '$pesan', NOW())");
    
    if ($query_insert) {
        $pesan_sukses = "Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.";
    }
}
?>
<div class="container my-4">
    <!-- Banner Foto Depan Panti (Setengah / Proporsional) -->
    <div class="card border-0 shadow-sm overflow-hidden text-center position-relative mb-4" style="height: 220px; border-radius: 8px;">
        <img src="assets/images/bagian depan panti.jpeg" alt="Kontak Panti" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.45); z-index: 1;"></div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center p-3 position-relative text-white" style="z-index: 2;">
            <h3 class="fw-bold mb-1" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">KONTAK</h3>
            <p class="small m-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">Hubungi kami untuk informasi lebih lanjut</p>
        </div>
    </div>

    <!-- Informasi Kontak & Alamat (Sesuai Desain Figma) -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card p-4 border-0 shadow-sm bg-white h-100">
                <h5 class="fw-bold text-success mb-3">INFORMASI PENGURUS</h5>
                <p class="mb-2"><strong>Nama Pimpinan:</strong> Rusmawati Dewi Abadi</p>
                <p class="mb-2"><strong>Telepon / WhatsApp:</strong> 0877-8795-9992</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 border-0 shadow-sm bg-white h-100">
                <h5 class="fw-bold text-success mb-3">ALAMAT SEKRETARIAT</h5>
                <p class="text-dark mb-0">
                    <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                    Dusun II Desa Buntu Kanna, Kec. Ponrang, Kabupaten Luwu, Sulawesi Selatan 91999
                </p>
            </div>
        </div>
    </div>

    <!-- Form Kirim Pesan -->
    <div class="card p-4 border-0 shadow-sm bg-white">
        <h4 class="text-success fw-bold mb-3">Kirim Pesan kepada Kami</h4>
        
        <?php if (!empty($pesan_sukses)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $pesan_sukses; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="index.php?page=kontak" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Pesan</label>
                <textarea name="pesan" rows="4" class="form-control" placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." required></textarea>
            </div>
            <button type="submit" name="kirim_pesan" class="btn btn-success fw-bold px-4">Kirim Pesan</button>
        </form>
    </div>
</div>