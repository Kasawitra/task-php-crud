<?php
require 'modul.php';

if(isset($_POST["regis"])){
    if (regis($_POST) > 0) {
        echo "<script>
        alert('User Baru Berhasil ditambahkan!');
        document.location.href = 'login.php';
        </script>";
        exit;
    } else {
        echo mysqli_error($db);
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Registrasi User</h1>
<div class="container">
        <div class="content">
            <form action="" method="post">
                <label for="username" >Username : </label>
                <input type="text" name="username" id="username">
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
                <label for="password2">Konfirmasi Password : </label>
                <input type="password" name="password2" id="password2">
                <button type="submit" name="regis">Register</button>
            </form>
        </div>
    </div>
</body>
</html>