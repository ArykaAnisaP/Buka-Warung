<?php
// error_reporting(0);
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'user') {
    echo '<script>window.location="masuk.php"</script>';
}
$userId = $_SESSION['id'];
$profile = mysqli_query($conn, "SELECT fullname, username, email, no_telp, password, reff FROM tb_user WHERE user_id = $userId");
$a = mysqli_fetch_object($profile);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profile User</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="fullname">Fullname</label>
                    <input type="text" name="fullname" class="input-control" placeholder="Fullname" value="<?php echo $a->fullname ?>" required>
                    <label for="username">Username</label>
                    <input type="text" name="username" class="input-control" placeholder="Username" value="<?php echo $a->username ?>" required>
                    <label for="email">Email</label>
                    <input type="text" name="email" class="input-control" placeholder="email" value="<?php echo $a->email ?>" required>
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" name="no_telp" class="input-control" placeholder="No_telp" value="<?php echo $a->no_telp ?>" required>
                    <!-- <label for="password">Password</label>
                    <input type="password" name="password" class="input-control" placeholder="password" required> -->
                    <label for="reff">Refferal</label>
                    <input type="text" name="reff" class="input-control" placeholder="Refferal" value="<?php echo $a->reff ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    // data inputan dari form
                    $fullname     = $_POST['fullname'];
                    $username         = $_POST['username'];
                    $email      = $_POST['email'];
                    $no_telp     = $_POST['no_telp'];
                    $reff    = $_POST['reff'];

                    // query update data produk
                    $update = mysqli_query($conn, "UPDATE tb_user SET 
												fullname = '" . $fullname . "',
												username = '" . $username . "',
												email = '" . $email . "',
												no_telp = '" . $no_telp . "',
												reff = '" . $reff . "'
												WHERE user_id = " . $userId . "");
                    if ($update) {
                        echo '<script>alert("Ubah data berhasil")</script>';
                        echo '<script>window.location="profile.php"</script>';
                    } else {
                        echo '<script>alert(' . mysqli_error($conn) . ')</script>';
                        echo 'gagal ' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>

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