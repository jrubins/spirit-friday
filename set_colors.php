<?php
	session_start();
	/*if(!$_SESSION['loggedIn']) {
		header("Location: index.php");
	}*/
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['comb_name'])) {
			$_SESSION['cur_comb'] = $_POST['comb_name'];
		}
	
		$_SESSION['color'] = $_POST['colors'];
	} else {
		header("Location: index.php");
	}

?>