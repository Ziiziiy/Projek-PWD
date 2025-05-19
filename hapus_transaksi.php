<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");

$koneksi = new mysqli("localhost", "root", "", "kas_db");
$id = $_GET['id'];
$id_admin = $_SESSION['id_admin'];

// Hapus hanya jika data milik admin
$stmt = $koneksi->prepare("DELETE FROM kas WHERE id=? AND id_admin=?");
$stmt->bind_param("ii", $id, $id_admin);
$stmt->execute();

header("Location: lihat_total.php");
exit();
?>
