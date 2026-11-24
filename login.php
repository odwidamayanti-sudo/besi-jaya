
<?php
session_start();

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin") {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | BESI JAYA</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #263746;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.login-box {
    background: white;
    width: 400px;
    max-width: 100%;
    padding: 40px 35px;
    border-radius: 12px;
    box-shadow: 0 10px 30px #0004;
    text-align: center;
}

.logo {
    font-size: 30px;
    font-weight: bold;
    color: #263746;
    margin-bottom: 8px;
}

.logo span {
    color: #e99b25;
}

.subtitle {
    color: #777;
    font-size: 14px;
    margin-bottom: 30px;
    line-height: 1.5;
}

h3 {
    color: #263746;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 13px;
    margin-bottom: 16px;
    border: 1px solid #ddd;
    border-radius: 7px;
    font-size: 14px;
}

input:focus {
    outline: none;
    border-color: #e99b25;
}

button {
    width: 100%;
    padding: 13px;
    background: #263746;
    color: white;
    border: none;
    border-radius: 7px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #e99b25;
}

.error {
    color: #d94343;
    font-size: 13px;
    margin-top: 15px;
}

.footer {
    margin-top: 28px;
    font-size: 12px;
    color: #999;
}
</style>
</head>

<body>

<div class="login-box">

    <div class="logo">BESI <span>JAYA</span></div>

    <p class="subtitle">
        Sistem Informasi Jual Beli<br>
        Besi Tua dan Barang Rongsokan
    </p>

    <h3>Login Admin</h3>

    <form method="POST">
        <input type="text"
               name="username"
               placeholder="Masukkan Username"
               required>

        <input type="password"
               name="password"
               placeholder="Masukkan Password"
               required>

        <button type="submit" name="login">
            MASUK
        </button>
    </form>

    <p class="error">
        <?= htmlspecialchars($error); ?>
    </p>

    <div class="footer">
        © 2026 BESI JAYA
    </div>

</div>

</body>
</html>
