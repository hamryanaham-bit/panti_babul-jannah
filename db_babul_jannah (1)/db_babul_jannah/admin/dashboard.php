<?php 
$page_title = "DASHBOARD ADMIN";
include '../includes/admin_header.php';

$tot_kegiatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM kegiatan"))['t'];
$tot_galeri   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM galeri"))['t'];
$tot_pesan    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM pesan_kontak"))['t'];
$tot_donasi   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM konfirmasi_donasi"))['t'];
?>

<div class="dashboard-cards">
    <div class="card-stat">
        <h4>Total Kegiatan</h4>
        <div class="number"><?php echo $tot_kegiatan; ?></div>
    </div>
    <div class="card-stat">
        <h4>Total Foto Galeri</h4>
        <div class="number"><?php echo $tot_galeri; ?></div>
    </div>
    <div class="card-stat">
        <h4>Donasi Masuk</h4>
        <div class="number"><?php echo $tot_donasi; ?></div>
    </div>
    <div class="card-stat">
        <h4>Pesan Kontak</h4>
        <div class="number"><?php echo $tot_pesan; ?></div>
    </div>
</div>

<div class="table-responsive">
    <h3>Pesan Kontak Terbaru</h3>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM pesan_kontak ORDER BY id DESC LIMIT 5");
            while ($r = mysqli_fetch_assoc($q)) {
                echo "<tr>
                    <td>{$r['nama']}</td>
                    <td>{$r['email']}</td>
                    <td>{$r['pesan']}</td>
                    <td>{$r['tanggal']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/admin_footer.php'; ?>