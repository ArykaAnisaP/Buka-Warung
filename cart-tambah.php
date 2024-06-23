<?php
session_start();

include 'db.php';
if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'user') {
    echo '<script>window.location="masuk.php"</script>';
}
$cek = mysqli_query($conn, "SELECT * FROM tb_cart WHERE user_id=" . $_SESSION['id'] . " && product_id=" . $_GET['id']);
if (mysqli_num_rows($cek) == 0) {

    $insert = mysqli_query($conn, "INSERT INTO tb_cart VALUES (null, '" . $_SESSION['id'] . "', '" . $_GET['id'] . "',1)");

    if ($insert) {
        echo '<script>alert("Tambah data berhasil")</script>';
        echo '<script>window.location="cart.php"</script>';
    } else {
        echo 'gagal ' . mysqli_error($conn);
    }
} else {
    echo '<script>window.location="cart.php"</script>';
}
