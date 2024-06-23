<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true || $_SESSION['type'] != 'user') {
	echo '<script>window.location="masuk.php"</script>';
}

$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
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
				<li><a href="profile.php">Profile</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" id='produk' placeholder="Cari Produk">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- category -->
	<div class="section">
		<div class="container">
			<h3>Kategori</h3>
			<div class="box">
				<?php
				$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
				if (mysqli_num_rows($kategori) > 0) {
					while ($k = mysqli_fetch_array($kategori)) {
				?>
						<a href="produk.php?kat=<?php echo $k['category_id'] ?>">
							<div class="col-5">
								<img src="img/icon-kategori.png" width="50px" style="margin-bottom:5px;">
								<p><?php echo $k['category_name'] ?></p>
							</div>
						</a>
					<?php }
				} else { ?>
					<p>Kategori tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- new product -->
	<div class="section">
		<div class="container">
			<h3>Produk Terbaru</h3>
			<div class="box">
				<?php
				$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
				if (mysqli_num_rows($produk) > 0) {
					while ($p = mysqli_fetch_array($produk)) {
				?>
						<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
							<div class="col-4">
								<img src="produk/<?php echo $p['product_image'] ?>">
								<p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
								<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
							</div>
						</a>
					<?php }
				} else { ?>
					<p>Produk tidak ada</p>
				<?php } ?>
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