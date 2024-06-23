<?php
session_start();
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address, atas_nama,nama_bank,admin_no_rek FROM tb_admin WHERE admin_id = 1");
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
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container" style="min-height: 700px;">
            <h2>Upload Bukti Bayar</h2>
            <div class="box">
                <h3>Tujuan Bank</h3>
                <br>
                <p>Silahkan Transfer ke pembayaran bank berikut dan unggah bikti pembayaran pada form dibawah.</p>
                <h4>Bank = <?php echo $a->nama_bank ?></h4>
                <h4>No. Rekening = <?php echo $a->admin_no_rek ?></h4>
                <h4>Atas Nama = <?php echo $a->atas_nama ?></h4>
                <br><br>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="bukti"> Upload Bukti Pembayaran Disini</label>
                    <input type="file" name="bukti" class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    // menampung data file yang diupload
                    $filename = $_FILES['bukti']['name'];
                    $tmp_name = $_FILES['bukti']['tmp_name'];
                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];
                    $newname = 'bukti_bayar' . time() . '.' . $type2;
                    // menampung data format file yang diizinkan
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                    // validasi format file
                    if (!in_array($type2, $tipe_diizinkan)) {
                        // jika format file tidak ada di dalam tipe diizinkan
                        echo '<script>alert("Format file tidak diizinkan")</scrtip>';
                    } else {
                        // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                        // proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './bukti_bayar/' . $newname);
                        //get data cart
                        $produk = mysqli_query($conn, "SELECT tb_cart.id, tb_cart.qty, tb_product.product_name, 
                        tb_product.product_price, tb_product.product_image
                        FROM tb_cart 
                        JOIN tb_product ON tb_cart.product_id=tb_product.product_id
                        WHERE tb_cart.user_id = " . $_SESSION['id'] . "");
                        $total_harga = 0;
                        if (mysqli_num_rows($produk) > 0) {
                            while ($row = mysqli_fetch_array($produk)) {
                                $total_harga += $row['product_price'] * $row['qty'];
                            }
                        }

                        //voucher
                        $potongan = 0;
                        $pesan_d = "";
                        $cart_v2 = mysqli_query($conn, "SELECT voucher.id, voucher.value, voucher.type, voucher.max_potongan FROM tb_cart_voucher JOIN voucher ON tb_cart_voucher.kode=voucher.kode WHERE tb_cart_voucher.user_id = 5");
                        if (mysqli_num_rows($cart_v2) > 0) {
                            $cv = mysqli_fetch_object($cart_v2);
                            if ($cv->type == "persen") {
                                $pesan_d = $cv->value . "Persen";
                                $potongan = $total_harga * ($cv->value / 100);
                                if ($cv->max_potongan) {
                                    $potongan = $cv->max_potongan;
                                }
                            } else {
                                $pesan_d = $cv->value . "Rupiah";
                                $potongan = $cv->value;
                            }

                            mysqli_query($conn, "DELETE FROM `tb_cart_voucher` WHERE `user_id` = " . $_SESSION['id'] . "");
                            mysqli_query($conn, "INSERT INTO `tb_riwayat_voucher` VALUES (null, " . $_SESSION['id'] . ", " . $cv->id . ", current_timestamp())");
                        }
                        $harga_bayar = $total_harga - $potongan;
                        $insert = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES (
										null,'" . $_SESSION['id'] . "',null,'menunggu konfirmasi','" . $newname .
                            "'," . $total_harga . "," . $harga_bayar . "," . $potongan . ") ");
                        $idt = mysqli_insert_id($conn);
                        if ($insert) {
                            $produk = mysqli_query($conn, "SELECT tb_product.product_id,tb_cart.id, tb_cart.qty, 
                            tb_product.product_name, tb_product.product_price, tb_product.product_image
                            FROM tb_cart 
                            JOIN tb_product ON tb_cart.product_id=tb_product.product_id
                            WHERE tb_cart.user_id = " . $_SESSION['id'] . "");
                            $total_harga = 0;
                            if (mysqli_num_rows($produk) > 0) {
                                var_dump($idt);
                                while ($row = mysqli_fetch_array($produk)) {
                                    echo mysqli_num_rows($produk);
                                    $insert_p = mysqli_query($conn, "INSERT INTO tb_transaksi_product VALUES (null, " .
                                        $idt . ", " . $row['product_id'] . ", " . $row['qty'] . "," . $row['product_price'] . ")");

                                    mysqli_query($conn, "UPDATE `tb_product` SET `stok` = stok - " . $row['qty'] .
                                        "  WHERE `tb_product`.`product_id` = " . $row['product_id'] . ";");
                                }
                            }
                            mysqli_query($conn, "DELETE FROM `tb_cart` WHERE `tb_cart`.`user_id` = " . $_SESSION['id'] . "");

                            // cek voucher
                            //jika ada 


                            echo '<script>alert("Tambah data berhasil")</script>';
                            echo '<script>window.location="transaksi.php"</script>';
                        } else {
                            echo 'gagal ' . mysqli_error($conn);
                        }
                    }
                }
                ?>



            </div>
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