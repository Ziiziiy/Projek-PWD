<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "kas_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['login'] = true;
        $_SESSION['id_admin'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Password atau Username salah!";
        header("Location: login.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style/login.css">
</head>

<body>

    <header>
        <nav>
            <h1>Login Admin</h1>
        </nav>
    </header>

    <div class="wrapper">
        <form method="POST">
            <div class="login-header">
                <span>Sign In Admin</span>
            </div>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p style="text-align:center; margin-top: 10px;">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </p>

        <div class="error">
            <?php
            if (isset($_SESSION['error'])) {
                echo "<div class='error'>{$_SESSION['error']}</div>";
                unset($_SESSION['error']);
            }
            ?>
        </div>

    </div>

    <footer>
        <p>©Designed by</p>
    </footer>

</body>

</html>