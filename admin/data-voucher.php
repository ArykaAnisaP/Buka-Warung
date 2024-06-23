<?php
session_start();
include '../db.php';
if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'admin') {
    echo '<script>window.location="login.php"</script>';
}
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
            <h3>Data Produk</h3>
            <div class="box">
                <p><a class="btn" href="tambah-voucher.php">Tambah Data</a></p>
                <br>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Nama Member</th>
                            <th>Kode Voucher</th>
                            <th>Deskripsi</th>
                            <th>Refferal</th>
                            <th>For All</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Max Potongan</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $voucher = mysqli_query($conn, "SELECT * FROM voucher");
                        if (mysqli_num_rows($voucher) > 0) {
                            while ($row = mysqli_fetch_array($voucher)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['kode'] ?></td>
                                    <td><?php echo $row['deskripsi'] ?></td>
                                    <td><?php echo $row['reff'] ?></td>
                                    <td><?php echo ($row['for_all'] == 1) ? 'True' : 'False'; ?></td>
                                    <td><?php echo $row['type'] ?></td>
                                    <td><?php echo $row['value'] ?></td>
                                    <td><?php echo $row['max_potongan'] ?></td>
                                    <td>
                                        <a href="edit-voucher.php?id=<?php echo $row['id'] ?>">Edit</a> ||
                                        <a href="proses-hapus.php?idv=<?php echo $row['id'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
                                    </td>
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
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - Bukawarung.</small>
        </div>
    </footer>
</body>

</html>