
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data barang
    $query = mysqli_query($conn, "
        SELECT * FROM barang
        WHERE id_barang='$id'
    ");

    $barang = mysqli_fetch_assoc($query);

    if ($barang) {

        // Hapus data transaksi terkait terlebih dahulu
        mysqli_query($conn, "
            DELETE FROM transaksi
            WHERE id_barang='$id'
        ");

        // Hapus foto jika tersedia
        if (!empty($barang['foto'])) {
            $file = "uploads/" . $barang['foto'];

            if (file_exists($file)) {
                unlink($file);
            }
        }

        // Hapus data barang
        $hapus = mysqli_query($conn, "
            DELETE FROM barang
            WHERE id_barang='$id'
        ");

        if ($hapus) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Data barang gagal dihapus.";
        }

    } else {
        echo "Data barang tidak ditemukan.";
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>
