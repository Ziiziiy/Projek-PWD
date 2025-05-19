<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "kas_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Cek apakah username sudah ada
    $cek = $koneksi->prepare("SELECT * FROM admin WHERE username = ?");
    $cek->bind_param("s", $user);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Simpan user baru TANPA HASH
        $stmt = $koneksi->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $success = "Registrasi berhasil! Silakan login.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register Admin</title>
    <link rel="stylesheet" href="style/login.css">
</head>

<body>
    <header>
        <nav>
            <h1>Register Admin</h1>
        </nav>
    </header>

    <div class="wrapper">
        <form method="POST">
            <div class="login-header">
                <span>Buat Akun Admin</span>
            </div>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <p style="text-align:center; margin-top: 10px;">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </p>
        <?php
        if (isset($error)) echo "<div class='error'>$error</div>";
        if (isset($success)) echo "<div class='success'>$success</div>";
        ?>
    </div>

    <footer>
        <p>©Designed by</p>
    </footer>
</body>

</html>