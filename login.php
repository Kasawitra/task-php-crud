<?php
session_start();
require 'modul.php';

if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"]; 

    $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            $_SESSION["login"] = $username;
            header("location: index.php");
            exit;
        } else if ($_SESSION["login"] = $username) {
            header("location: index.php");
            exit;
        }
    }
    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Halaman Login</h1>

    <div class="container">
        <div class="content">
<?php if (isset($error)) : ?>
<p class="pesan">Username atau Password anda salah!</p>
<?php endif; ?>
            <form action="" method="post">
                <label for="username">Username : </label>
                <input type="text" name="username" id="username">
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
                <button type="submit" name="login">Login</button>
            </form>
            <p>Belum punya akun? klik <a href="registrasi.php">Registrasi</a></p>
        </div>
    </div>
</body>
</html>