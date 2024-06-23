<?php
session_start();
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'user') {
    echo '<script>window.location="masuk.php"</script>';
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukawarung</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">Bukawarung</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="transaksi.php">Transaksi</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Data Transaksi</h3>
            <?php
            $transaksi = mysqli_query($conn, "SELECT * FROM `tb_transaksi` WHERE user_id=" . $_SESSION['id'] . "");
            if (mysqli_num_rows($transaksi) > 0) {
                while ($trans = mysqli_fetch_array($transaksi)) {

            ?>
                    <div class="box">
                        <h4>Id Transaksi = <?= $trans['transaksi_id'] ?></h4>
                        <h4>Id Transaksi = <?= $trans['created_at'] ?></h4>
                        <h4>Total Harga = <?= number_format($trans['harga_total']) ?></h4>
                        <h4>Total Diskon = <?= number_format($trans['total_potongan']) ?></h4>
                        <h4>Total Bayar = <?= number_format($trans['harga_bayar']) ?></h4>
                        <h4>Status = <?= $trans['status'] ?></h4>
                        <table border="1" cellspacing="0" class="table">
                            <thead>
                                <tr>
                                    <th width="60px">No</th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Total Harga</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total_harga = 0;
                                $produk = mysqli_query($conn, "SELECT tb_transaksi_product.qty ,tb_transaksi_product.harga_satuan, 
                        tb_product.product_name, tb_product.product_image 
                        FROM tb_transaksi_product 
                        JOIN tb_product ON tb_transaksi_product.product_id=tb_product.product_id
                        WHERE tb_transaksi_product.transaksi_id = " . $trans['transaksi_id'] . "");

                                if (mysqli_num_rows($produk) > 0) {
                                    while ($row = mysqli_fetch_array($produk)) {

                                        $total_harga += $row['harga_satuan'] * $row['qty'];


                                ?>
                                        <!-- <br>
                                        <p><a class="btn" href="produk.php">Produk diterima</a></p>
                                        </br> -->

                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank">
                                                    <img src="produk/<?php echo $row['product_image'] ?>" width="50px"> </a></td>
                                            <td><?php echo $row['product_name'] ?></td>
                                            <td style="width: 150px;">Rp. <?php echo number_format($row['harga_satuan']) ?></td>
                                            <td style="width: 150px;"><?php echo $row['qty'] ?></td>
                                            <td style="width: 150px;">Rp. <?php echo number_format($row['harga_satuan'] * $row['qty']) ?></td>

                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="7">Tidak ada data</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php
                }
            } else {
                ?>
                <div class="box">
                    <h4>Belum Ada Transaksi</h4>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>No. Hp</h4>
            <p><?php echo $a->admin_telp ?></p>
            <small>Copyright &copy; 2020 - Bukawarung.</small>
        </div>
    </div>
</body>

</html>