<?php
session_start();

if ($_SESSION["login"] == null) {
    header('location: login.php');
    exit;
}

$username = $_SESSION["login"];

require 'modul.php';

$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

while ($row = mysqli_fetch_assoc($result)){
    $user = $row["username"];
    if ($username !== $user) {
        header('location: login.php');
        exit;
    }
}

if(isset($_POST["bagikan"])){
    $username = $_SESSION["login"];
    $date = date("Y-d-m");
    $comment = htmlspecialchars($_POST["posting"]);
    $query = "INSERT INTO comment
                VALUES 
                ('', '$username', '$date', '$comment')";
    mysqli_query($db, "$query");

    if (mysqli_affected_rows($db) > 0) {
        echo "Postingan kamu telah dibagikan!";
    } else {
        echo "Postingan kamu gagal dibagikan!";
    };
};



$dataComment = query("SELECT * FROM comment");
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Selamat Datang, <?= $username; ?></h1>
    <hr>

<div class="feedcontainer">
    <div class="feedcontent">
        <form action="" method="post">
        <label for="posting">Apa yang sedang kamu pikirkan?</label>
        <input type="text" name="posting" id="posting" placeholder="Tulis ceritamu disini...">
        <button type="submit" name="bagikan" id="bagikan">Bagikan</button>
        </form>

        <?php foreach ($dataComment as $row) : ?>
        <div class="comment"><?= $row["username"]; ?><br>
        <?= $row["tgl"] ?><br>
        <p><?= $row["textcomment"]; ?></p><br>
        <?php if ($row["username"] == $_SESSION["login"]) : ?>
        <a href="hapus.php?id=<?= $row["idcomment"]; ?>" onclick="return confirm('Yakin ingin menghapus comment?');">Hapus</a>
        <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<a href="logout.php" class="logout">Logout</a>
    
</body>
</html>