<?php
session_start();
include '../db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'admin') {
    echo '<script>window.location="login.php"</script>';
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukawarung</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">Bukawarung</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="data-voucher.php">Data Voucher</a></li>
                <li><a href="data-transaksi.php">Data Transaksi</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Data Transaksi</h3>
            <?php
            $transaksi = mysqli_query($conn, "SELECT tb_transaksi.transaksi_id, tb_transaksi.user_id, tb_transaksi.created_at, 
            tb_transaksi.status, tb_transaksi.bukti_pembayaran, tb_transaksi.harga_total,tb_transaksi.total_potongan,tb_transaksi.harga_bayar, tb_user.fullname FROM `tb_transaksi` 
            JOIN tb_user on tb_transaksi.user_id=tb_user.user_id ORDER BY tb_transaksi.created_at DESC");
            if (mysqli_num_rows($transaksi) > 0) {
                while ($trans = mysqli_fetch_array($transaksi)) {
            ?>
                    <div class="box">
                        <h4>Nama Pemesan = <?= $trans['fullname'] ?></h4>
                        <h4>Id Transaksi = <?= $trans['transaksi_id'] ?></h4>
                        <h4>Total Harga = <?= number_format($trans['harga_total']) ?></h4>
                        <h4>Total Diskon = <?= number_format($trans['total_potongan']) ?></h4>
                        <h4>Total Bayar = <?= number_format($trans['harga_bayar']) ?></h4>
                        <h4 style="margin-bottom: 30px;">Status = <?= $trans['status'] ?></h4>

                        <span style="display: inline-block; margin-right: 30px;">
                            <h4>Bukti Pembayaran</h4>
                            <td><a href="../bukti_bayar/<?php echo $trans['bukti_pembayaran'] ?>" target="_blank"> 
                            <img src="../bukti_bayar/<?php echo $trans['bukti_pembayaran'] ?>" width="150px"> </a></td>
                        </span>
                        <span style="display: inline-block; margin-right: 30px;">
                            <table border="1" cellspacing="0" class="table">
                                <thead>
                                    <tr>
                                        <th width="60px">No</th>
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
                                            <tr>
                                                <td><?php echo $no++ ?></td>

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
                        </span>
                        <?php
                        if ($trans['status'] === 'menunggu konfirmasi') {
                        ?>
                        <br><br>
                            <a style="display: inline-block;" href="status-proses.php?valid=true&id=<?= $trans['transaksi_id'] ?>">
                                <div>
                                    <div style="padding: 10px;background-color: green;width:200px;color:white;border-radius: 15px;">
                                        Valid
                                    </div>
                                </div>
                            </a>
                            <a style="display: inline-block;" href="status-proses.php?valid=false&id=<?= $trans['transaksi_id'] ?>">
                                <div>
                                    <div style="padding: 10px;background-color: red;width:200px;color:white;border-radius: 15px;">
                                        Tidak Valid
                                    </div>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
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