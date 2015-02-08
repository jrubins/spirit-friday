<?php
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		require_once('../includes/database.php');
		db_connect();
		
		$product_id = $_POST['id'];
		
		$delete_product_query = "DELETE FROM product WHERE product_id=" . $product_id;
		mysql_query($delete_product_query);
		
		$delete_color_query = "DELETE FROM color WHERE product_id=" . $product_id;
		mysql_query($delete_color_query);
		
		$response = array();
		$response['id'] = $product_id;
		echo json_encode($response);
	} else {
		header("Location: ../real_index.php");
	}

?>