<?php

session_start();
include '../db.php';
if($_SESSION['status_login'] != true || $_SESSION['type'] != 'admin'){
    echo '<script>window.location="login.php"</script>';
}
var_dump($_GET['valid']);
if (isset($_GET['valid']) && isset($_GET['id'])) {
    if ($_GET['valid'] == 'true') {
        mysqli_query($conn, "UPDATE `tb_transaksi` SET `status` = 'Barang Telah Dikirim' WHERE `tb_transaksi`.`transaksi_id` = " . $_GET['id'] . ";");
    } else if ($_GET['valid'] == 'false') {
        mysqli_query($conn, "UPDATE `tb_transaksi` SET `status` = 'Pembayaran Tidak Valid' WHERE `tb_transaksi`.`transaksi_id` = " . $_GET['id'] . ";");

        $produk = mysqli_query($conn, "SELECT * FROM `tb_transaksi_product` WHERE transaksi_id=".$_GET['id']."");

        if (mysqli_num_rows($produk) > 0) {
            while ($row = mysqli_fetch_array($produk)) {
                mysqli_query($conn, "UPDATE `tb_product` SET `stok` = stok + ".$row['qty']." WHERE `tb_product`.`product_id` = ".$row['product_id'].";");
            }
        }

    }
}
echo '<script>window.location="data-transaksi.php"</script>';