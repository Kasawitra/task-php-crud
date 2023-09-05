<?php

require 'modul.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>
        alert('Comment Berhasil di Hapus');
        document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
    alert('Comment Gagal di Hapus');
    document.location.href = 'index.php';
    </script>";
};

?>