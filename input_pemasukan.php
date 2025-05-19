<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");

if ($_POST) {
    $nominal = $_POST['nominal'];
    $asal = $_POST['asal'];
    $tanggal = $_POST['tanggal'];
    $id_admin = $_SESSION['id_admin'];

    $koneksi = new mysqli("localhost", "root", "", "kas_db");
    $stmt = $koneksi->prepare("INSERT INTO kas (jenis, nominal, asal, tanggal_manual, id_admin) VALUES ('masuk', ?, ?, ?, ?)");
    $stmt->bind_param("issi", $nominal, $asal, $tanggal, $id_admin);
    $stmt->execute();
    
    echo "Pemasukan berhasil dicatat!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Pemasukan</title>
    <link rel="stylesheet" href="style/input_uang.css">
</head>
<body>
    <form method="POST">
        <h2>Input Pemasukan</h2>
        <input type="number" name="nominal" placeholder="Jumlah Uang Masuk" required><br>
        <input type="text" name="asal" placeholder="Asal Uang" required><br>
        <input type="date" name="tanggal" required><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="dashboard.php">Kembali</a>
</body>
</html>
