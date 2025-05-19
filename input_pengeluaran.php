<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");

if ($_POST) {
    $nominal = $_POST['nominal'];
    $asal = $_POST['asal'];
    $tanggal = $_POST['tanggal'];
    $id_admin = $_SESSION['id_admin'];

    $koneksi = new mysqli("localhost", "root", "", "kas_db");
    $stmt = $koneksi->prepare("INSERT INTO kas (jenis, nominal, asal, tanggal_manual, id_admin) VALUES ('keluar', ?, ?, ?, ?)");
    $stmt->bind_param("issi", $nominal, $asal, $tanggal, $id_admin);
    $stmt->execute();
    
    echo "Pengeluaran berhasil dicatat!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Pengeluaran</title>
    <link rel="stylesheet" href="style/input_pengeluaran.css">
</head>
<body>
    <form method="POST">
        <h2>Input Pengeluaran</h2>
        <input type="number" name="nominal" placeholder="Jumlah Uang Keluar" required><br>
        <input type="text" name="asal" placeholder="Keperluan" required><br>
        <input type="date" name="tanggal" required><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="dashboard.php">Kembali</a>
</body>
</html>
