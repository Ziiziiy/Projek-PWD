<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");

$koneksi = new mysqli("localhost", "root", "", "kas_db");
$id = $_GET['id'];
$id_admin = $_SESSION['id_admin'];

// Ambil data hanya jika milik admin yang login
$data = $koneksi->query("SELECT * FROM kas WHERE id=$id AND id_admin=$id_admin")->fetch_assoc();

if (!$data) {
    echo "Transaksi tidak ditemukan atau Anda tidak berhak mengedit.";
    exit();
}

if ($_POST) {
    $jenis = $_POST['jenis'];
    $nominal = $_POST['nominal'];
    $asal = $_POST['asal'];
    $tanggal = $_POST['tanggal']; // format: YYYY-MM-DD
    $stmt = $koneksi->prepare("UPDATE kas SET jenis=?, nominal=?, asal=?, tanggal_manual=? WHERE id=? AND id_admin=?");
    $stmt->bind_param("sissii", $jenis, $nominal, $asal, $tanggal, $id, $id_admin); // perbaikan di sini
    $stmt->execute();
    header("Location: lihat_total.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <h2>Edit Transaksi</h2>
        <select name="jenis" required>
            <option value="masuk" <?= $data['jenis'] == 'masuk' ? 'selected' : '' ?>>Masuk</option>
            <option value="keluar" <?= $data['jenis'] == 'keluar' ? 'selected' : '' ?>>Keluar</option>
        </select><br>
        <input type="number" name="nominal" value="<?= $data['nominal'] ?>" required><br>
        <input type="text" name="asal" value="<?= $data['asal'] ?>" required><br>
        <input type="date" name="tanggal" value="<?= date('Y-m-d', strtotime($data['tanggal_manual'])) ?>" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="lihat_total.php">Kembali</a>
</body>
</html>
