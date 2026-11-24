
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "besitua_3602";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
