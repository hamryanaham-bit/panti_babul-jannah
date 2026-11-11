<?php
// Pastikan koneksi database terpanggil
if (!isset($conn)) {
    include_once 'config/database.php';
}

$pesan_notif = "";

// Proses ketika tombol konfirmasi donasi ditekan
if (isset($_POST['kirim_donasi'])) {
    $nama    = trim($_POST['nama']);
    $nominal = trim($_POST['nominal']);
    $metode  = trim($_POST['metode']);
    
    if (!empty($nama) && !empty($nominal) && !empty($metode)) {
        // Gunakan prepared statement agar aman dari error kutip SQL
        $stmt = mysqli_prepare($conn, "INSERT INTO donasi (nama, nominal, metode, tanggal) VALUES (?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "sis", $nama, $nominal, $metode);
        
        if (mysqli_stmt_execute($stmt)) {
            $pesan_notif = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Terima kasih! Konfirmasi donasi Anda berhasil dikirim dan masuk ke sistem admin.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
        } else {
            $pesan_notif = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Gagal menyimpan data: " . mysqli_error($conn) . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<div class="container my-4">
    <!-- Banner Foto Depan Panti (Setengah / Proporsional) -->
    <div class="card border-0 shadow-sm overflow-hidden text-center position-relative mb-4" style="height: 220px; border-radius: 8px;">
        <img src="assets/images/bagian depan panti.jpeg" alt="Donasi Panti" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.45); z-index: 1;"></div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center p-3 position-relative text-white" style="z-index: 2;">
            <h3 class="fw-bold mb-1" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">SALURKAN DONASI ANDA</h3>
            <p class="small m-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">Berbagi Kebahagiaan dan Rezeki Bersama Anak-Anak Panti</p>
        </div>
    </div>

    <!-- Informasi Rekening Donasi -->
    <div class="card p-4 border-0 shadow-sm bg-white mb-4">
        <h4 class="text-success fw-bold mb-3">Rekening Resmi Panti Asuhan Babul Jannah</h4>
        <p class="text-dark">Bagi para dermawan yang ingin menyalurkan sebagian rezekinya, dapat melalui rekening berikut:</p>
        <ul>
            <li><strong>Bank BRI:</strong> 1234-5678-9012 (An. Panti Asuhan Babul Jannah)</li>
            <li><strong>Bank Mandiri:</strong> 9876-5432-1098 (An. Panti Asuhan Babul Jannah)</li>
        </ul>
    </div>

    <!-- Form Konfirmasi Donasi -->
    <div class="card p-4 border-0 shadow-sm bg-white mb-4">
        <h4 class="text-success fw-bold mb-3">Form Konfirmasi Donasi</h4>
        
        <?php echo $pesan_notif; ?>

        <form action="index.php?page=donasi" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Donatur / Hamba Allah</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Nominal Donasi (Rp)</label>
                <input type="number" name="nominal" class="form-control" placeholder="Contoh: 100000" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Metode / Bank Pengiriman</label>
                <input type="text" name="metode" class="form-control" placeholder="Contoh: Transfer BRI / BSI" required>
            </div>
            <button type="submit" name="kirim_donasi" class="btn btn-success fw-bold px-4">Kirim Konfirmasi Donasi</button>
        </form>
    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>