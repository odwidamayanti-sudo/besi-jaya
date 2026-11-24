
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$barang = mysqli_fetch_assoc($data);

$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $berat = $_POST['berat'];
    $harga = $_POST['harga_per_kg'];
    $kondisi = $_POST['kondisi'];
    $tanggal = $_POST['tanggal_masuk'];

    $foto = $barang['foto'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = time() . "_" . basename($_FILES['foto']['name']);
        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            "uploads/" . $foto
        );
    }

    $sql = "UPDATE barang SET
        id_kategori='$id_kategori',
        nama_barang='$nama',
        deskripsi='$deskripsi',
        berat='$berat',
        harga_per_kg='$harga',
        kondisi='$kondisi',
        tanggal_masuk='$tanggal',
        foto='$foto'
        WHERE id_barang='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Barang</title>
</head>
<body>

<h2>Edit Data Barang</h2>

<form method="POST" enctype="multipart/form-data">

    Nama Barang:<br>
    <input type="text" name="nama_barang"
    value="<?= htmlspecialchars($barang['nama_barang']); ?>" required>
    <br><br>

    Kategori:<br>
    <select name="id_kategori" required>
        <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
        <option value="<?= $k['id_kategori']; ?>"
        <?= $k['id_kategori'] == $barang['id_kategori'] ? 'selected' : ''; ?>>
            <?= htmlspecialchars($k['nama_kategori']); ?>
        </option>
        <?php } ?>
    </select>
    <br><br>

    Deskripsi:<br>
    <textarea name="deskripsi" required><?= htmlspecialchars($barang['deskripsi']); ?></textarea>
    <br><br>

    Berat (Kg):<br>
    <input type="number" step="0.01" name="berat"
    value="<?= $barang['berat']; ?>" required>
    <br><br>

    Harga per Kg:<br>
    <input type="number" name="harga_per_kg"
    value="<?= $barang['harga_per_kg']; ?>" required>
    <br><br>

    Kondisi:<br>
    <input type="radio" name="kondisi" value="Layak"
    <?= $barang['kondisi'] == 'Layak' ? 'checked' : ''; ?>> Layak

    <input type="radio" name="kondisi" value="Tidak Layak"
    <?= $barang['kondisi'] == 'Tidak Layak' ? 'checked' : ''; ?>> Tidak Layak
    <br><br>

    Tanggal Masuk:<br>
    <input type="date" name="tanggal_masuk"
    value="<?= $barang['tanggal_masuk']; ?>" required>
    <br><br>

    Foto Barang:<br>
    <input type="file" name="foto" accept="image/*">
    <br><br>

    <button type="submit" name="update">Update Barang</button>

</form>

<br>
<a href="dashboard.php">Kembali ke Dashboard</a>

</body>
</html>
