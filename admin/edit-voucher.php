<?php
session_start();
include '../db.php';
if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'admin') {
    echo '<script>window.location="login.php"</script>';
}

$voucher = mysqli_query($conn, "SELECT * FROM voucher WHERE id = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($voucher) == 0) {
    echo '<script>window.location="data-voucher.php"</script>';
}
$p = mysqli_fetch_object($voucher);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukawarung</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Bukawarung</a></h1>
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

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Edit Data Voucher</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="nama">Nama Member</label>
                    <input type="text" name="nama" class="input-control" placeholder="Nama" value="<?php echo $p->nama ?>" required>
                    <label for="harga">Kode Voucher</label>
                    <input type="text" name="kode" class="input-control" placeholder="Kode" value="<?php echo $p->kode ?>" required>
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" name="deskripsi" class="input-control" placeholder="Deskripsi" value="<?php echo $p->deskripsi ?>" required>
                    <label for="refferal">Refferal</label>
                    <input type="text" name="reff" class="input-control" placeholder="Refferal" value="<?php echo $p->reff ?>" required>
                    <label for="for_all">For All</label>
                    <select class="input-control" name="for_all">
                        <!-- <option value="">--Pilih--</option> -->
                        <option value=1 <?php echo ($p->type == 1) ? 'selected' : ''; ?>>True</option>
                        <option value=0 <?php echo ($p->type == 0) ? 'selected' : ''; ?>>False</option>
                    </select>
                    <label for="type">Type</label>
                    <select class="input-control" name="type">
                        <!-- <option value="">--Pilih--</option> -->
                        <option value="persen" <?php echo ($p->type == "persen") ? 'selected' : ''; ?>>Persen</option>
                        <option value="nominal" <?php echo ($p->type == "nominal") ? 'selected' : ''; ?>>Nominal</option>
                    </select>
                    <label for="value">Value</label>
                    <input type="text" name="value" class="input-control" placeholder="Value" value="<?php echo $p->value ?>" required>
                    <label for="max_potongan">Max Potongan</label>
                    <input type="text" name="max_potongan" class="input-control" placeholder="Max potongan" value="<?php echo $p->max_potongan ?>" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    // data inputan dari form
                    $nama     = $_POST['nama'];
                    $kode         = $_POST['kode'];
                    $deskripsi         = $_POST['deskripsi'];
                    $reff     = $_POST['reff'];
                    $for_all    = $_POST['for_all'];
                    $type    = $_POST['type'];
                    $value     = $_POST['value'];
                    $max_potongan          = $_POST['max_potongan'];

                    // query update data produk
                    $update = mysqli_query($conn, "UPDATE voucher SET 
												nama = '" . $nama . "',
												kode = '" . $kode . "',
												deskripsi = '" . $deskripsi . "',
												reff = '" . $reff . "',
												for_all = '" . $for_all . "',
												type = '" . $type . "',
												value = '" . $value . "',
												max_potongan = '" . $max_potongan . "'
												WHERE id = '" . $p->id . "'	");
                    if ($update) {
                        echo '<script>alert("Ubah data berhasil")</script>';
                        echo '<script>window.location="data-voucher.php"</script>';
                    } else {
                        echo 'gagal ' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - Bukawarung. </small>
        </div>
    </footer>

</body>

</html>