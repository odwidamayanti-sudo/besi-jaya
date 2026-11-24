
<?php
include 'koneksi.php';

$query = mysqli_query($conn, "
    SELECT barang.*, kategori.nama_kategori
    FROM barang
    JOIN kategori ON barang.id_kategori = kategori.id_kategori
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BESI JAYA - Jual Beli Besi Tua</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f3f6;
            color: #263746;
        }

        header {
            background: #263746;
            color: white;
            padding: 22px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #f39c12;
        }

        header a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .hero {
            background: #34495e;
            color: white;
            text-align: center;
            padding: 65px 20px;
        }

        .hero h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .hero p {
            line-height: 1.7;
        }

        .container {
            padding: 40px 7%;
        }

        .container h2 {
            margin-bottom: 10px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 25px;
        }

        .produk {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .no-foto {
            height: 170px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5e7eb;
            color: #777;
        }

        .detail {
            padding: 18px;
        }

        .detail h3 {
            margin-bottom: 10px;
        }

        .kategori {
            color: #777;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .harga {
            color: #e99419;
            font-weight: bold;
            font-size: 18px;
        }

        .berat {
            margin-top: 8px;
            font-size: 14px;
        }

        footer {
            background: #263746;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            header {
                flex-direction: column;
                gap: 15px;
            }

            .hero h2 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>BESI JAYA</h1>

    <nav>
        <a href="index.php">Beranda</a>
        <a href="login.php">Login Admin</a>
    </nav>
</header>

<section class="hero">
    <h2>Jual Beli Besi Tua dan Barang Rongsokan</h2>
    <p>
        BESI JAYA menyediakan berbagai jenis besi tua dan barang rongsokan.
        <br>
        Lihat daftar barang yang tersedia di bawah ini.
    </p>
</section>

<div class="container">
    <h2>Daftar Barang</h2>
    <p class="subtitle">Barang yang tersedia di BESI JAYA</p>

    <div class="produk">

        <?php while ($row = mysqli_fetch_assoc($query)) { ?>

            <div class="card">

                <?php if (!empty($row['foto']) &&
                    file_exists("uploads/" . $row['foto'])) { ?>

                    <img
                        src="uploads/<?php echo htmlspecialchars($row['foto']); ?>"
                        alt="Foto Barang">

                <?php } else { ?>

                    <div class="no-foto">Foto belum tersedia</div>

                <?php } ?>

                <div class="detail">

                    <h3>
                        <?php echo htmlspecialchars($row['nama_barang']); ?>
                    </h3>

                    <p class="kategori">
                        <?php echo htmlspecialchars($row['nama_kategori']); ?>
                    </p>

                    <p class="harga">
                        Rp <?php echo number_format($row['harga_per_kg'], 0, ',', '.'); ?>/Kg
                    </p>

                    <p class="berat">
                        Berat tersedia: <?php echo $row['berat']; ?> Kg
                    </p>

                    <p class="berat">
                        Kondisi: <?php echo htmlspecialchars($row['kondisi']); ?>
                    </p>

                </div>
            </div>

        <?php } ?>

    </div>
</div>

<footer>
    &copy; 2026 BESI JAYA - Sistem Informasi Jual Beli Besi Tua
</footer>

</body>
</html>
