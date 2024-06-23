<?php
// session_start();
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
    <title>Login Page</title>
</head>
<body>
    <div class="input">
        <h1>LOGIN</h1>
        <form action="" method="POST">
            <div class="box-input">
                <i class="fas fa-envelope-open-text"></i>
                <input name="email" type="text" placeholder="Email" required>
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input name="pass" type="password" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" value="Login" class="btn-input">Login </button>
            <div class="button">
                <p style="color: white;">Belum Punya Akun
                    <a href="daftar.php">Register disini</a>
                </p>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            session_start();
            include 'db.php';

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '" . $email . 
            "' AND password = '" . MD5($pass) . "'");
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['type'] = 'user';
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->user_id;
                echo '<script>window.location="./"</script>';
            } else {
                echo '<script>alert("Email atau password Anda salah!")</script>';
            }
        }
        ?>
    </div>
</body>
</html>