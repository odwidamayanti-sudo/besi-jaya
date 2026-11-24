
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$totalBarang = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM barang"
))['total'];

$totalKategori = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM kategori"
))['total'];

$totalBerat = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COALESCE(SUM(berat),0) AS total FROM barang"
))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | BESI JAYA</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f1f3f6;
    color: #263746;
}

.sidebar {
    width: 230px;
    height: 100vh;
    position: fixed;
    background: #263746;
    padding: 25px 18px;
}

.logo {
    color: #f5a623;
    font-size: 25px;
    font-weight: bold;
}

.sidebar p {
    color: #cbd5df;
    font-size: 12px;
    margin-bottom: 35px;
}

.menu {
    display: block;
    color: white;
    text-decoration: none;
    padding: 13px;
    margin-bottom: 8px;
    border-radius: 7px;
}

.menu:hover, .active {
    background: #40576b;
}

.main {
    margin-left: 230px;
    padding: 30px;
}

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.topbar h2 {
    margin: 0;
}

.logout {
    background: #c0392b;
    color: white;
    padding: 10px 17px;
    text-decoration: none;
    border-radius: 6px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.card {
    background: white;
    padding: 22px;
    border-radius: 10px;
    border-left: 5px solid #e99b25;
    box-shadow: 0 2px 8px #0000000d;
}

.card h3 {
    margin: 0 0 12px;
    font-size: 14px;
    color: #777;
}

.card strong {
    font-size: 25px;
}

.content {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 8px #0000000d;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}

.btn-tambah {
    background: #e99b25;
    color: white;
    padding: 11px 16px;
    text-decoration: none;
    border-radius: 6px;
}

.btn-tambah:hover {
    background: #ce8517;
}

.info {
    margin-top: 15px;
    color: #777;
    line-height: 1.6;
}

footer {
    text-align: center;
    color: #888;
    font-size: 12px;
    margin-top: 25px;
}

@media(max-width: 800px) {
    .sidebar {
        width: 170px;
    }

    .main {
        margin-left: 170px;
        padding: 15px;
    }

    .cards {
        grid-template-columns: 1fr;
    }
}
</style>
</head>

<body>

<div class="sidebar">

    <div class="logo">BESI JAYA</div>

    <p>Sistem Informasi Jual Beli Besi Tua</p>

    <a href="dashboard.php" class="menu active">
        ▦ Dashboard
    </a>

    <a href="data_barang.php" class="menu">
        ▤ Data Barang
    </a>

    <a href="logout.php" class="menu">
        ↪ Logout
    </a>

</div>

<div class="main">

    <div class="topbar">
        <div>
            <h2>Dashboard</h2>
            <p>Selamat datang, <?= htmlspecialchars($_SESSION['username']); ?> BESI JAYA!</p>
        </div>

        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="cards">

        <div class="card">
            <h3>Total Jenis Barang</h3>
            <strong><?= $totalBarang; ?></strong>
        </div>

        <div class="card">
            <h3>Total Kategori</h3>
            <strong><?= $totalKategori; ?></strong>
        </div>

        <div class="card">
            <h3>Total Berat Barang</h3>
            <strong>
                <?= number_format($totalBerat, 2, ',', '.'); ?> Kg
            </strong>
        </div>

    </div>

    <div class="content">

        <div class="content-header">
            <h3>Selamat Datang di BESI JAYA</h3>
        </div>

        <p class="info">
            BESI JAYA merupakan sistem informasi yang digunakan
            untuk membantu pengelolaan jual beli besi tua dan
            barang rongsokan. Melalui sistem ini, admin dapat
            mengelola data barang, kategori, berat, harga,
            serta kondisi barang dengan lebih mudah.
        </p>

        <a href="data_barang.php" class="btn-tambah">
            Lihat Data Barang
        </a>

    </div>

    <footer>
        © 2026 BESI JAYA | Sistem Informasi Jual Beli Besi Tua dan Rongsokan
    </footer>

</div>

</body>
</html>
