<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: login.php");

$koneksi = new mysqli("localhost", "root", "", "kas_db");
$id_admin = $_SESSION['id_admin']; // ambil ID admin dari session

// Ambil data khusus admin ini
$masuk = $koneksi->query("SELECT SUM(nominal) as total FROM kas WHERE jenis='masuk' AND id_admin = $id_admin")->fetch_assoc()['total'] ?? 0;
$keluar = $koneksi->query("SELECT SUM(nominal) as total FROM kas WHERE jenis='keluar' AND id_admin = $id_admin")->fetch_assoc()['total'] ?? 0;
$transaksi = $koneksi->query("SELECT * FROM kas WHERE id_admin = $id_admin ORDER BY tanggal_manual DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lihat Total</title>
    <link rel="stylesheet" href="style/lihat_total.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <header>
        <nav>
            <h1>Dashboard</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </nav>
    </header>

    <h2>Statistik Kas</h2>
    <canvas id="chartKas" width="300" height="300"></canvas>
    <script>
        const ctx = document.getElementById('chartKas');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Masuk', 'Keluar', 'Sisa'],
                datasets: [{
                    data: [<?= $masuk ?>, <?= $keluar ?>, <?= $masuk - $keluar ?>],
                    backgroundColor: ['green', 'red', 'blue']
                }]
            }
        });
    </script>

    <h3>Riwayat Transaksi</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Asal / Keterangan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = $transaksi->fetch_assoc()) {
            $jenisClass = $row['jenis'] == 'masuk' ? 'masuk' : 'keluar';
            echo "<tr>
                    <td>{$no}</td>
                    <td class='{$jenisClass}'>" . ucfirst($row['jenis']) . "</td>
                    <td>Rp " . number_format($row['nominal'], 0, ',', '.') . "</td>
                    <td>{$row['asal']}</td>
                    <td>" . date('d-m-Y', strtotime($row['tanggal_manual'] ?? $row['created_at'])) . "</td>
                    <td>
                        <a href='edit_transaksi.php?id={$row['id']}'>Edit</a> |
                        <a href='hapus_transaksi.php?id={$row['id']}' onclick=\"return confirm('Yakin mau hapus?')\">Hapus</a>
                    </td>
                </tr>";
            $no++;
        }
        ?>
    </table>

    <h3 style="text-align: center; margin-top: 20px;">
        Total Uang Kas Saat Ini:
        <span>
            Rp <?= number_format($masuk - $keluar, 0, ',', '.') ?>
        </span>
    </h3>

    <a href="dashboard.php">Kembali</a>
</body>

</html>
