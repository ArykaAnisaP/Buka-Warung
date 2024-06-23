<?php 
	session_start();
	include '../db.php';
	if($_SESSION['status_login'] != true || $_SESSION['type'] != 'admin'){
		echo '<script>window.location="login.php"</script>';
	}
		
	$total_produk=mysqli_query($conn, "SELECT COUNT(product_id) as c from tb_product");
	$tp=mysqli_fetch_object($total_produk);
	$total_kat=mysqli_query($conn, "SELECT COUNT(category_id) as c from tb_category");
	$tk=mysqli_fetch_object($total_kat);
	$total_tran=mysqli_query($conn, "SELECT COUNT(transaksi_id) as c,  SUM(harga_total) 
	as s from tb_transaksi WHERE status = 'Barang Telah Dikirim'");
	$tt=mysqli_fetch_object($total_tran);

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
			<h3>Dashboard</h3>
			<div class="box">
				<h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di Toko Online</h4>
				<div class="col-4">
					<h4>Total Produk</h4>
					<h1><?=$tp->c?></h1>
				</div>
				<div class="col-4">
					<h4>Total Kategori</h4>
					<h1><?=$tk->c?></h1>
				</div>
				<div class="col-4">
					<h4>Total Transaksi Berhasil</h4>
					<h1><?=$tt->c?></h1>
				</div>
				<div class="col-4">
					<h4>Total Pembayaran Berhasil</h4>
					<h3>Rp. <?=$tt->s?></h3>
				</div>
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