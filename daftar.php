<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="css/auth.css" media="screen" title="no title">
    <title>Register Page</title>
</head>

<body>
    <div class="input">
        <h1>REGISTER</h1>
        <form action="" method="post">
            <div class="box-input">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Fullname" required>
            </div>
            <div class="box-input">
                <i class="fas fa-address-card"></i>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="box-input">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="box-input">
                <i class="fas fa-address-book"></i>
                <input type="text" name="nohp" placeholder="NoHp">
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="pass" placeholder="Password">
            </div>
            <div class="box-input">
                <i class="fas fa-address-book"></i>
                <input type="text" name="reff" placeholder="Refferal">
            </div>
            <button type="submit" name="submit" class="btn-input">REGISTER</button>
            <div class="button">
                <p style="color: white;">Sudah Punya Akun
                    <a href="masuk.php">Login disini</a>
                </p>
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $name     = $_POST['name'];
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $nohp     = $_POST['nohp'];
            $pass     = $_POST['pass'];
            $reff     = $_POST['reff'];

            $insert = mysqli_query($conn, "INSERT INTO tb_user VALUES (
                null,'" . $name . "','" . $username . "','" . $email . "','" . $nohp . "','" . MD5($pass) . "','" . $reff . "') ");
            if ($insert) {
                echo '<script>alert("Berhasil Daftar")</script>';
                echo '<script>window.location="masuk.php"</script>';
            } else {
                echo 'gagal ' . mysqli_error($conn);
            }
        }
        ?>
    </div>
</body>

</html>