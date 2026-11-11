<?php
if (isset($_POST['submit_daftar'])) {
    include_once 'config/database.php';
    
    $nama_lengkap  = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nik           = mysqli_real_escape_string($conn, $_POST['nik']);
    $tempat_lahir  = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $alamat        = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp         = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $nama_ortu     = mysqli_real_escape_string($conn, $_POST['nama_ortu']);

    $query = "INSERT INTO pendaftaran (nama_lengkap, nik, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, no_hp, nama_ortu) 
              VALUES ('$nama_lengkap', '$nik', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$no_hp', '$nama_ortu')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Pendaftaran berhasil dikirim! Terima kasih telah mendaftar.";
    } else {
        $error = "Gagal mendaftar: " . mysqli_error($conn);
    }
}
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0 fw-bold">FORMULIR PENDAFTARAN SANTRI / ANAK ASUH</h5>
                </div>
                <div class="card-body p-4 bg-white">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">NIK</label>
                            <input type="text" class="form-control" name="nik" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Nomor HP / WhatsApp</label>
                            <input type="text" class="form-control" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Nama Orang Tua / Wali</label>
                            <input type="text" class="form-control" name="nama_ortu" required>
                        </div>
                        <button type="submit" name="submit_daftar" class="btn btn-success w-100 py-2 fw-bold shadow-sm">KIRIM PENDAFTARAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>