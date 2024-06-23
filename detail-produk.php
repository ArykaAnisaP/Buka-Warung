<?php
error_reporting(0);
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'user') {
    echo '<script>window.location="masuk.php"</script>';
}

$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
$p = mysqli_fetch_object($produk);
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.11/jquery.autocomplete.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#produk").autocomplete({
			serviceUrl: "get_data.php",
			dataType: "JSON",
			onSelect: function(suggestion) {
				$("#produk").val(suggestion.search);
			}
		});
	})
</script>

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

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" id='produk' placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- product detail -->
	<div class="section">
		<div class="container">
			<h3>Detail Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="produk/<?php echo $p->product_image ?>" width="100%">
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name ?></h3>
					<h4>Rp. <?php echo number_format($p->product_price) ?></h4>
					<h5>Stok <?php echo $p->stok ?></h5>
					<p>Deskripsi :<br>
						<?php echo $p->product_description ?>
					</p>
					<?php
					if ($p->stok > 0) {
					?>
						<a style="display: inline-block;" href="cart-tambah.php?id=<?= $p->product_id ?>">
							<div>
								<div style="padding: 10px;background-color: green;width:250px;color:white;border-radius: 15px;">
									Masukan ke Keranjang
								</div>
							</div>
						</a>
					<?php
					} else {
					?>

						<div>
							<div style="padding: 10px;background-color: grey;width:250px;color:white;border-radius: 15px;">
								stok habis
							</div>
							</a>
						<?php
					}
						?>
						</div>
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