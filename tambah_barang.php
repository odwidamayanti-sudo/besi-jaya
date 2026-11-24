
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $berat = $_POST['berat'];
    $harga = $_POST['harga_per_kg'];
    $kondisi = $_POST['kondisi'];
    $tanggal = $_POST['tanggal_masuk'];

    $foto = "";
    if (!empty($_FILES['foto']['name'])) {
        $foto = time() . "_" . basename($_FILES['foto']['name']);
        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            "uploads/" . $foto
        );
    }

    $sql = "INSERT INTO barang
    (id_kategori, nama_barang, deskripsi, berat,
    harga_per_kg, kondisi, tanggal_masuk, foto)
    VALUES ('$id_kategori', '$nama', '$deskripsi',
    '$berat', '$harga', '$kondisi', '$tanggal', '$foto')";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Barang</title>
</head>
<body>

<h2>Tambah Data Barang</h2>

<form method="POST" enctype="multipart/form-data">

    Nama Barang:<br>
    <input type="text" name="nama_barang" required><br><br>

    Kategori:<br>
    <select name="id_kategori" required>
        <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
        <option value="<?= $k['id_kategori']; ?>">
            <?= htmlspecialchars($k['nama_kategori']); ?>
        </option>
        <?php } ?>
    </select><br><br>

    Deskripsi:<br>
    <textarea name="deskripsi" required></textarea><br><br>

    Berat (Kg):<br>
    <input type="number" step="0.01" name="berat" required><br><br>

    Harga per Kg:<br>
    <input type="number" name="harga_per_kg" required><br><br>

    Kondisi Barang:<br>
    <input type="radio" name="kondisi" value="Layak" required> Layak
    <input type="radio" name="kondisi" value="Tidak Layak"> Tidak Layak
    <br><br>

    Tanggal Masuk:<br>
    <input type="date" name="tanggal_masuk" required><br><br>

    Foto Barang:<br>
    <input type="file" name="foto" accept="image/*"><br><br>

    <button type="submit" name="simpan">Simpan Barang</button>

</form>

<br>
<a href="dashboard.php">Kembali ke Dashboard</a>

</body>
</html>
