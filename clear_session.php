<?php
	session_start();
	if(isset($_SESSION['color'])) {
		//echo "in here";
		unset($_SESSION['color']);
	}
	if(isset($_SESSION['filter'])) {
		//echo "in here";
		unset($_SESSION['filter']);
	}
	if(isset($_SESSION['brand'])) {
		//echo "in here";
		unset($_SESSION['brand']);
	}
	if(isset($_SESSION['store'])) {
		//echo "in here";
		unset($_SESSION['store']);
	}
	if(isset($_SESSION['price'])) {
		//echo "in here";
		unset($_SESSION['price']);
	}
	
	header("Location: real_index.php");
?>