<?php
$db = mysqli_connect("localhost", "root", "", "test");

function query ($query){
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function regis($data){
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    $result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");
    
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username telah digunakan!');</script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>Konfirmasi Password tidak cocok!</script>";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($db, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($db);
}

function hapus($id){
    global $db;
    mysqli_query($db, "DELETE FROM comment WHERE idcomment = $id");
    return mysqli_affected_rows($db);
}

?>