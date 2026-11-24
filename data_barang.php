
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

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
    <title>Data Barang - BESI JAYA</title>

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

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #263746;
            position: fixed;
            padding: 25px 20px;
            color: white;
        }

        .sidebar h2 {
            color: #f39c12;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #3c5265;
        }

        .content {
            margin-left: 250px;
            padding: 30px 25px;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin-bottom: 12px;
        }

        .header p {
            font-size: 14px;
        }

        .btn {
            background: #f39c12;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th {
            background: #263746;
            color: white;
            padding: 12px 10px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .foto {
            width: 65px;
            height: 55px;
            object-fit: cover;
            border-radius: 5px;
        }

        .edit {
            color: #0879c9;
            text-decoration: none;
        }

        .hapus {
            color: red;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>BESI JAYA</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="data_barang.php">Data Barang</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <div class="container">

        <div class="header">
            <div>
                <h2>Data Barang</h2>
                <p>Daftar inventaris besi tua dan barang rongsokan.</p>
            </div>

            <a href="tambah_barang.php" class="btn">
                + Tambah Barang
            </a>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Foto</th>
                <th>Kategori</th>
                <th>Berat (Kg)</th>
                <th>Harga/Kg</th>
                <th>Kondisi</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            while ($row = mysqli_fetch_assoc($query)) {
            ?>

            <tr>
                <td><?php echo $no++; ?></td>

                <td>
                    <?php echo htmlspecialchars($row['nama_barang']); ?>
                </td>

                <td>
                    <?php if (!empty($row['foto']) &&
                        file_exists("uploads/" . $row['foto'])) { ?>

                        <img
                            src="uploads/<?php echo htmlspecialchars($row['foto']); ?>"
                            class="foto"
                            alt="Foto Barang">

                    <?php } else { ?>
                        Tidak ada foto
                    <?php } ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['nama_kategori']); ?>
                </td>

                <td><?php echo $row['berat']; ?></td>

                <td>
                    Rp <?php echo number_format($row['harga_per_kg'], 0, ',', '.'); ?>
                </td>

                <td><?php echo $row['kondisi']; ?></td>

                <td><?php echo $row['tanggal_masuk']; ?></td>

                <td>
                    <a class="edit"
                       href="edit_barang.php?id=<?php echo $row['id_barang']; ?>">
                        Edit
                    </a>

                    |

                    <a class="hapus"
                       href="hapus_barang.php?id=<?php echo $row['id_barang']; ?>"
                       onclick="return confirm('Yakin ingin menghapus barang ini?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>
