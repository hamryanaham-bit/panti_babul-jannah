<?php
session_start();
include_once '../config/database.php';

$error = '';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Menggunakan enkripsi MD5 sesuai default database

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Panti Asuhan Babul Jannah</title>
    <!-- Memanggil CSS Admin dengan benar -->
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <h3 class="text-center mb-4 text-success">Login Admin</h3>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="login" class="btn btn-success w-100">MASUK</button>
            </form>
            <div class="text-center mt-3">
                <a href="../index.php" class="text-decoration-none text-muted">← Kembali ke Website Utama</a>
            </div>
        </div>
    </div>
</body>
</html>