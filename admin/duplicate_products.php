<?php
	session_start();
	require_once('../includes/database.php');
	db_connect();
	if(!$_SESSION['admin']) {
		header("Location: ../index.php");
	}
	
	$product_query = "SELECT * FROM product";
	if(!($product_result = mysql_query($product_query))) {
		die(mysql_error());
	}
	$duplicate = false;
	while($product_row = mysql_fetch_array($product_result)) {
		$duplicate_query = "SELECT * FROM product WHERE gender='" . $product_row['gender'] . "' AND kind='" . $product_row['kind'] . "' AND price=" . $product_row['price'] . " AND link='" . $product_row['link'] . "' AND brand='" . $product_row['brand'] . "' AND merchant='" . $product_row['merchant'] . "'";
		if(!($duplicate_result = mysql_query($duplicate_query))) {
			die(mysql_error());
		}
		if(mysql_num_rows($duplicate_result) != 0) {
			while($duplicate_row = mysql_fetch_array($duplicate_result)) {
				if($product_row['product_id'] != $duplicate_row['product_id']) {
					$color_reference1 = "SELECT * FROM color WHERE product_id=" . $product_row['product_id'];
					$color_reference2 = "SELECT * FROM color WHERE product_id=" . $duplicate_row['product_id'];
					if(!($reference1_result = mysql_query($color_reference1))) {
						die(mysql_error());
					}
					if(!($reference2_result = mysql_query($color_reference2))) {
						die(mysql_error());
					}
					if((mysql_num_rows($reference1_result) != 0 || mysql_num_rows($reference2_result) != 0) && ($product_row['product_id'] < $duplicate_row['product_id'])) {
						$duplicate = true;
						if(mysql_num_rows($reference2_result) == 0) {
							/*$delete_query = "DELETE FROM product WHERE product_id=" . $duplicate_row['product_id'];
							if(!mysql_query($delete_query)) {
								die(mysql_error());
							}*/
						}
						echo "<div style='border:1px solid #000;margin:10px 0;padding:0 10px;'>";
						echo "<p>" . $product_row['product_id'] . " " . $duplicate_row['product_id'] . "</p>";
						
						if(mysql_num_rows($reference1_result) != 0) {
							echo "<p>" . $product_row['product_id'] . ": " . mysql_num_rows($reference1_result) . " references</p>";
						} else {
							echo "<p>" . $product_row['product_id'] . ": 0 references</p>";
						}
						if(mysql_num_rows($reference2_result) != 0) {
							echo "<p>" . $duplicate_row['product_id'] . ": " . mysql_num_rows($reference2_result) . " references</p>";
						} else {
							echo "<p>" . $duplicate_row['product_id'] . ": 0 references</p>";
						}
						
						
						echo "</div>";
					}
				}
			}
		}
	}
	if(!$duplicate) {
		echo "<p>No duplicates!<p>";
	}
?>