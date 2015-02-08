<?php
	session_start();
	if(!$_SESSION['loggedIn']) {
		header("Location: index.php");
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$_SESSION['filter'] = $_POST['filters'];
		$_SESSION['brand'] = $_POST['brands'];
		$_SESSION['store'] = $_POST['stores'];
		$_SESSION['price'] = $_POST['prices'];
	} else {
		header("Location: real_index.php");
	}
?>