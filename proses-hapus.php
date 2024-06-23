<?php 
	
	session_start();
	include './db.php';
	if($_SESSION['status_login'] != true || $_SESSION['type'] != 'user'){
		echo '<script>window.location="login.php"</script>';
	}
	if(isset($_GET['id'])){
		$delete = mysqli_query($conn, "DELETE FROM tb_cart WHERE id = '".$_GET['id']."' ");
		echo '<script>window.location="cart.php"</script>';
	}


?>