<?php
	session_start();
	$gender = $_GET['gender'];
	if(isset($_SESSION['filter'])) {
		unset($_SESSION['filter']);
	}
	if(isset($_SESSION['brand'])) {
		unset($_SESSION['brand']);
	}
	if(isset($_SESSION['price'])) {
		unset($_SESSION['price']);
	}
	header("Location: product.php?gender=$gender");
?>