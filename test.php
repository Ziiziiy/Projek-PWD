<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");

$koneksi = new mysqli("localhost", "root", "", "kas_db");
$id_admin = $_SESSION['id_admin']; // Ambil ID admin dari session
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/test.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>

    <header>
        <nav>
            <h1>Dashboard SATU</h1>
            <h2>Selamat datang, <?= $_SESSION['username'] ?></h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </nav>
    </header>

    <div class="wrapper">
        <section class="intro">
            <div class="intro-text">
                <h2>Sistem Pencatatan Transaksi Kas <span class="highlight">Multifungsi</span></h2>
                <p>Anda dapat dengan mudah mengelola arus keuangan kas serta menghitung total keuangan yang masuk dan keluar.</p>
            </div>
            <div class="intro-img">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwTzKuy2z30AWVYMn1ViHftclB0-mhWd8c_Q&s" alt="Ilustrasi Buku Kas">
            </div>
        </section>
        <section class="intro">
        <div class="intro-img">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJ4jB4TybQ5Is-j7b7QBwwWOj1Ep7o9vuueN7cLg4nII66YywG0Bz50WKI94xybBaukFk&usqp=CAU" alt="Tampilan Dashboard">
        </div>
        <div class="intro-text">
            <h2>Akses dan Input Transaksi Kas <span class="highlight">dari Mana Saja</span></h2>
            <p>Anda dapat mengaksesnya dari berbagai platform, termasuk perangkat seluler, komputer, atau bahkan tablet.</p>
        </div>
    </section>

        <!-- Menu pilihan -->
        <section class="layout">
            <div class="menu-box"><a href="input_pemasukan.php">Input Pemasukan</a><br>Masukkan uang kas beserta keterangan dan tanggal</div>
            <div class="menu-box"><a href="input_pengeluaran.php">Input Pengeluaran</a><br>Catat uang kas yang keluar dengan detail</div>
            <div class="menu-box"><a href="lihat_total.php">Lihat Total & Riwayat</a><br>Total uang kas dan grafik transaksi</div>
        </section>
    </div>

    <section class="feature-section">
        <h2>Memahami Buku Kas</h2>
        <h3>Tentang Buku Kas Secara Umum dan Fitur di Aplikasi Ini</h3>

        <div class="grid-info">
            <div class="info-card">
                <h4>Apa Fungsi Utama Buku Kas?</h4>
                <p>Buku Kas membantu mencatat arus keuangan masuk dan keluar, serta memudahkan analisis laporan keuangan kas secara praktis dan efisien.</p>
            </div>
            <div class="info-card">
                <h4>Apa Bedanya Buku Kas Manual dengan Digital?</h4>
                <p>Buku Kas digital memungkinkan pencatatan otomatis dan akses data real-time, lebih praktis dibandingkan versi manual.</p>
            </div>
            <div class="info-card">
                <h4>Siapa yang Membutuhkan Buku Kas?</h4>
                <p>Usaha kecil, UMKM, organisasi, atau individu yang ingin mengelola keuangan secara rapi dan transparan.</p>
            </div>
            <div class="info-card">
                <h4>Apakah Layanan Ini Gratis?</h4>
                <p>Fitur pencatatan kas di aplikasi ini dapat digunakan gratis tanpa biaya tambahan.</p>
            </div>
        </div>
    </section>
    </div>

    <footer>
        <p>©Designed by</p>
    </footer>

</body>

</html>