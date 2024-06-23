<?php
error_reporting(0);
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
				<input type="text" name="search" id='produk' placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- new product -->
	<div class="section">
		<div class="container">
			<h3>Produk</h3>
			<div>
				<form action="" method="get">
					<label for="urut">Urutkan:</label>
					<select id="urut" name="urut" onchange='if(this.value != 0) { this.form.submit(); }'>
						<option value="terbaru" <?php if ($_GET['urut'] == "terbaru") {
													echo 'selected';
												} ?>>Terbaru</option>
						<option value="tertinggi" <?php if ($_GET['urut'] == "tertinggi") {
														echo 'selected';
													} ?>>Harga Tertinggi</option>
						<option value="terendah" <?php if ($_GET['urut'] == "terendah") {
														echo 'selected';
													} ?>>Harga Terendah</option>
					</select>
					<?php if ($_GET['search'] != '') : ?>
						<input type="hidden" name="search" value="<?= $_GET['search'] ?>">
					<?php endif; ?>
					<?php if ($_GET['kat'] != '') : ?>
						<input type="hidden" name="kat" value="<?= $_GET['kat'] ?>">
					<?php endif; ?>
					<input type="hidden" name="cari" value="Cari Produk">
				</form>
			</div>
			<div class="box">
				<?php
				if ($_GET['search'] != '' || $_GET['kat'] != '') {
					$where = "AND product_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%' ";
				}
				if ($_GET['urut'] != '') {
					$urut = "";
					switch ($_GET['urut']) {
						case 'terbaru':
							$urut = "ORDER BY data_created DESC";
							break;
						case 'tertinggi':
							$urut = "ORDER BY product_price DESC";
							break;
						case 'terendah':
							$urut = "ORDER BY product_price ASC";
							break;
						default:
							# code...
							break;
					}
				}

				$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where $urut");
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